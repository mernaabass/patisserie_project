from flask import Flask, render_template, request, jsonify, redirect, url_for, flash, session
import pymysql
from datetime import datetime
from werkzeug.security import generate_password_hash, check_password_hash
from functools import wraps

app = Flask(__name__)
app.secret_key = 'patisserie'


# db_config = {
#     'host': 'localhost',
#     'port': 3306,
#     'user': 'root',
#     'password': '4221345',
#     'database': 'patisserie',
#     'charset': 'utf8mb4',
#     'cursorclass': pymysql.cursors.DictCursor
# }


db_config = {
    'host': 'db',  
    'port': 3306,
    'user': 'root',
    'password': '4221345',
    'database': 'patisserie',
    'charset': 'utf8mb4',
    'cursorclass': pymysql.cursors.DictCursor
}


def get_db_connection():
    try:
        conn = pymysql.connect(**db_config)
        return conn
    except pymysql.MySQLError as err:
        print(f"Database connection error: {err}")
        return None

# الراوتات الأساسية
@app.route('/')
def index():
    return render_template('index.html')

@app.route('/about')
def about():
    return render_template('about.html')

@app.route('/menu')
def menu():
    return render_template('menu.html')

@app.route('/contact')
def contact():
    return render_template('contact.html')

@app.route('/faqs')
def faqs():
    return render_template('faqs.html')

@app.route('/services')
def services():
    return render_template('services.html')

# تسجيل حساب جديد
@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        username = request.form['username']
        email = request.form['email']
        password = generate_password_hash(request.form['password'])

        conn = get_db_connection()
        with conn.cursor() as cursor:
            sql = "INSERT INTO users (username, email, password, created_at) VALUES (%s, %s, %s, %s)"
            cursor.execute(sql, (username, email, password, datetime.now()))
            conn.commit()
        conn.close()
        flash('Registration successful. Please login.', 'success')
        return redirect(url_for('login'))

    return render_template('register.html')

# تسجيل الدخول
@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        email = request.form['email']
        password_input = request.form['password']

        conn = get_db_connection()
        with conn.cursor() as cursor:
            cursor.execute("SELECT * FROM users WHERE email=%s", (email,))
            user = cursor.fetchone()
        conn.close()

        if user and check_password_hash(user['password'], password_input):
            session['user_id'] = user['id']
            session['username'] = user['username']
            session['role'] = user['role']
            flash('Logged in successfully!', 'success')
            return redirect(url_for('index'))
        else:
            flash('Invalid email or password', 'danger')

    return render_template('login.html')


@app.route('/logout')
def logout():
    session.clear()
    flash('You have been logged out.', 'info')
    return redirect(url_for('index'))


def admin_required(f):
    @wraps(f)
    def decorated_function(*args, **kwargs):
        if session.get('role') != 'admin':
            flash('Admins only!', 'danger')
            return redirect(url_for('login'))
        return f(*args, **kwargs)
    return decorated_function

@app.route('/admin-dashboard')
@admin_required
def admin_dashboard():
    conn = get_db_connection()
    with conn.cursor() as cursor:
        cursor.execute("SELECT * FROM orders ORDER BY created_at DESC")
        orders = cursor.fetchall()
    conn.close()
    return render_template('admin-dashboard.html', orders=orders)


@app.route('/submit_order', methods=['POST'])
def submit_order():
    data = request.form
    required_fields = ['name', 'email', 'phone', 'order_name']
    for field in required_fields:
        if not data.get(field):
            return jsonify({'status': 'error', 'message': f'Please provide {field}'}), 400

    if '@' not in data['email'] or '.' not in data['email']:
        return jsonify({'status': 'error', 'message': 'Please enter a valid email'}), 400

    if len(data['phone']) < 11:
        return jsonify({'status': 'error', 'message': 'Phone number must be at least 11 digits'}), 400

    try:
        conn = get_db_connection()
        if conn is None:
            return jsonify({'status': 'error', 'message': 'Database connection error'}), 500

        with conn.cursor() as cursor:
            sql = """
                INSERT INTO orders (name, email, phone, order_name, created_at) 
                VALUES (%s, %s, %s, %s, %s)
            """
            values = (
                data['name'],
                data['email'],
                data['phone'],
                data['order_name'],
                datetime.now()
            )
            cursor.execute(sql, values)
            conn.commit()

        conn.close()
        return jsonify({'status': 'success', 'message': 'Thank you! We will contact you soon'})

    except Exception as e:
        print(f"Error during order submission: {e}")
        return jsonify({'status': 'error', 'message': 'An error occurred, please try again'}), 500


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=8888, debug=True)

