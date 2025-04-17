# 🐘 Simple PHP + MySQL (Single Container) on AWS Fargate

This project demonstrates how to run a **PHP web application with MySQL embedded in the same container** using **Amazon ECS Fargate**. It uses a custom Docker image that installs Apache, PHP, MySQL, and initializes the database using an `init.sql` script — all inside **one container**.

---

## 📦 Folder Structure

```
.
├── app/
│   └── index.php
├── init.sql
└── Dockerfile
```

---

## 🚀 Features

- ✅ Runs Apache + PHP + MySQL in a single Fargate task
- ✅ Initializes the database and inserts demo data on boot
- ✅ Uses `PDO` to connect from PHP to MySQL on `127.0.0.1`
- ✅ Suitable for demos, proof-of-concepts, and testing
- ✅ Fully deployable using AWS CloudFormation

---

 
 

## 🧪 Local Testing

1. **Build Docker image**
   ```bash
   docker build -t php-mysql-single .
   ```

2. **Run container**
   ```bash
   docker run -d -p 8080:80 --name test-php-mysql php-mysql-single
   ```

3. **Visit**
   ```
   http://localhost:8080
   ```

---

## ☁️ Deploy to AWS Fargate

### 1. Push image to ECR

```bash
# Authenticate
aws ecr get-login-password --region us-east-1 | docker login --username AWS --password-stdin <account-id>.dkr.ecr.us-east-1.amazonaws.com

# Create repo
aws ecr create-repository --repository-name php-mysql-single

# Build & push
docker build -t php-mysql-single .
docker tag php-mysql-single:latest <account-id>.dkr.ecr.us-east-1.amazonaws.com/php-mysql-single:latest
docker push <account-id>.dkr.ecr.us-east-1.amazonaws.com/php-mysql-single:latest
```

### 2. Deploy using CloudFormation

Use the `simple-php-website-fargate-single-task.yml` CloudFormation template. It includes:
- IAM Role
- ECS Cluster
- Log Group
- Fargate Service

---

## 📌 Notes

- MariaDB is installed via `default-mysql-server`, so we use MariaDB-compatible SQL.
- This is **not suitable for production** (no volume persistence or TLS).
- For larger setups, consider separating MySQL (RDS) or multi-container ECS tasks.

---

## 👏 Credits

Built with ❤️ using:
- PHP 8.2 + Apache
- MariaDB (via `default-mysql-server`)
- AWS ECS Fargate + CloudFormation
