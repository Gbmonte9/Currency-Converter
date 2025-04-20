# 💱 Currency Converter with React + PHP

This is a simple currency conversion project made with **React** on the frontend and **PHP + MySQL** on the backend. It allows you to convert values ​​between different currencies and save the data in the database.

---

## 🚀 How to run the project

### ✅ Prerequisites

- [Node.js](https://nodejs.org/)
- [XAMPP](https://www.apachefriends.org/pt_br/index.html)
- Modern browser (Chrome, Firefox, etc.)

---

### ⚙️ Steps to execute

1. **Clone the repository**

```bash
git clone https://github.com/Gbmonte9/Currency-Converter.git
```

2. **Move the project folder to the XAMPP directory**

Place the `conversion` folder in:

```
C:\xampp\htdocs\
```

The full path it will be:

```
C:\xampp\htdocs\conversion\
```

3. **Import the database**

- Access: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
- Create a database with the name: `conversion_db`
- (Optional) Import the `conversion_db.sql` file if it is included in the repository

4. **Start Apache and MySQL through XAMPP**

Open the **XAMPP Control Panel** and click on "Start" in the services:

- Apache ✅
- MySQL ✅

5. **Install the frontend dependencies**

Open the terminal and go to the frontend folder:

```bash
cd C:\xampp\htdocs\conversion\frontend
npm install
```

6. **Start React frontend**

```bash
npm start
```

7. **Access the application**

Open the browser and access:

```
http://localhost:3000
```

React will take care of the interface and send the data to PHP via API.

---

## 📁 Project Structure

```
conversion/
├── backend/
│ ├── api.php
│ ├── db.php
│ └── ...
├── frontend/
│ ├── public/
│ ├── src/
│ ├── package.json
│ └── ...
```

---
## 📝 Notes

- React communicates with PHP using `axios`.
- The backend is located at `http://localhost/conversion/backend/`. - Make sure CORS is enabled in PHP (`header("Access-Control-Allow-Origin")`).

---

## 🖼️ Screenshot

You can see a video of the project in action on my [LinkedIn]([https://www.linkedin.com/in/gabriel-rodrigues-mt/](https://www.linkedin.com/feed/update/urn:li:activity:7319528204002557952/?originTrackingId=GNZ3O40BRbi00irm4bRJwQ%3D%3D)).

---

## 👤 Author

**Gabriel Rodrigues**
Full Stack Developer in Training

[LinkedIn](https://www.linkedin.com/in/gabriel-rodrigues-mt/)
