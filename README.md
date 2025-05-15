# AWS Fargate Examples

Welcome to the **AWS Fargate Examples** repository! This collection showcases multiple open-source projects designed to be easily hosted on AWS ECS Fargate. Each project includes necessary configuration files such as Docker Compose files, Dockerfiles, and ECS Fargate CloudFormation stacks, providing a straightforward way to deploy and manage containers on AWS Fargate.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Project Structure](#project-structure)
  - [How to Use](#how-to-use)
- [Projects](#projects)
  - [Mautic](#Mautic)
  - [GoLang](#GoLang) 
- [CI/CD Workflow](#cicd-workflow)
- [Contributing](#contributing)
- [License](#license)

## Introduction

AWS Fargate allows you to run containers without having to manage the underlying infrastructure. This repository provides examples to help you quickly get started with deploying containerized applications on AWS ECS Fargate. Each example demonstrates a different use case, ranging from simple web servers to more complex, multi-container setups.

## Features

- Ready-to-use Docker Compose files and Dockerfiles for various projects
- CloudFormation templates to deploy ECS Fargate stacks seamlessly
- Easy to customize and extend for your specific use cases
- Suitable for beginners and experienced developers looking to learn or implement AWS Fargate

## Getting Started

### Prerequisites

Before you begin, ensure you have the following tools installed:

- **AWS CLI**: To interact with AWS services.
- **Docker**: To build and run containers locally.
- **AWS Account**: Required to deploy to ECS Fargate.
- **AWS CloudFormation**: To create the necessary AWS resources using templates.

### Project Structure

```plaintext
aws-fargate-examples/
│
├── Mautic/
│   ├── Dockerfile
│   ├── docker-compose.yml
│   └── cloudformation-template.yaml
│
├── GoLang/
│   ├── Dockerfile
│   ├── docker-compose.yml
│   └── cloudformation-template.yaml
│
└── README.md

```


### How to Use

1. **Clone the Repository**:
    ```bash
    git clone https://github.com/AvinashDalvi89/aws-fargate-examples.git
    cd aws-fargate-examples
    ```

2. **Build the Docker Image**:
    Navigate to a project directory and build the Docker image:
    ```bash
    docker build -t mautic-local-test .

    docker run -d --name mautic-local -p 8081:80 \
  -e MAUTIC_DB_HOST=db \
  -e MAUTIC_DB_NAME=mautic \
  -e MAUTIC_DB_USER=mautic \
  -e MAUTIC_DB_PASSWORD=mautic_password \
  -e MAUTIC_TRUSTED_PROXIES='["0.0.0.0/0"]' \
  mautic-local-test

    ```

3. **Run Locally**:
    ```bash
    docker-compose up
    ```

4. **Deploy to AWS Fargate**:
    Use the provided CloudFormation template to create the necessary ECS Fargate stack:
    ```bash
    aws cloudformation deploy --template-file project-1/cloudformation-template.yaml --stack-name project-1-stack
    ```

### Contributing
We welcome contributions! Feel free to fork the repository, create a new branch, and submit a pull request. Please ensure your code is well-documented and adheres to best practices.

## CI/CD Workflow

This repository includes a GitHub Actions workflow for continuous integration and deployment to AWS Fargate. The workflow automatically builds Docker images and deploys them to AWS using CloudFormation templates.

### Workflow Features

- Builds Docker images for all projects in the repository
- Pushes images to Amazon ECR
- Deploys applications using CloudFormation templates
- Uses OIDC for secure authentication with AWS

### Setup Instructions

To use the CI/CD workflow:

1. Set up an IAM role in your AWS account for GitHub Actions OIDC authentication
2. Add the role ARN as a GitHub secret named `AWS_ROLE_ARN`
3. Create the necessary ECR repositories in your AWS account

For detailed instructions, see the [CI/CD Workflow README](.github/workflows/README.md).

### License
This project is licensed under the MIT License - see the LICENSE file for details.