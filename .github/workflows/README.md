# GitHub Actions CI/CD Workflow for AWS Fargate Examples

This directory contains the GitHub Actions workflow for building and deploying the AWS Fargate examples to AWS.

## Workflow Overview

The `aws-fargate-deploy.yml` workflow performs the following actions:

1. Builds Docker images for both Mautic and simple-php-website projects
2. Pushes these images to Amazon ECR
3. Deploys the applications using CloudFormation templates

## Prerequisites

Before using this workflow, you need to set up the following:

### 1. AWS IAM Role for OIDC Authentication

Create an IAM role in your AWS account that can be assumed by GitHub Actions using OIDC:

1. Create an identity provider in IAM for GitHub Actions:
   - Provider type: OpenID Connect
   - Provider URL: `https://token.actions.githubusercontent.com`
   - Audience: `sts.amazonaws.com`

2. Create an IAM role with the following trust policy (replace `YOUR_GITHUB_ORG` and `YOUR_REPO_NAME`):
   ```json
   {
     "Version": "2012-10-17",
     "Statement": [
       {
         "Effect": "Allow",
         "Principal": {
           "Federated": "arn:aws:iam::YOUR_ACCOUNT_ID:oidc-provider/token.actions.githubusercontent.com"
         },
         "Action": "sts:AssumeRoleWithWebIdentity",
         "Condition": {
           "StringEquals": {
             "token.actions.githubusercontent.com:aud": "sts.amazonaws.com"
           },
           "StringLike": {
             "token.actions.githubusercontent.com:sub": "repo:YOUR_GITHUB_ORG/YOUR_REPO_NAME:*"
           }
         }
       }
     ]
   }
   ```

3. Attach the following policies to the role:
   - `AmazonECR-FullAccess`
   - `AmazonECS-FullAccess`
   - `AmazonCloudFormationFullAccess`
   - `IAMFullAccess` (or a more restricted policy that allows creating the roles defined in the CloudFormation templates)

### 2. GitHub Secret

Add the following secret to your GitHub repository:

- `AWS_ROLE_ARN`: The ARN of the IAM role created above (e.g., `arn:aws:iam::123456789012:role/GitHubActionsRole`)

### 3. Amazon ECR Repositories

Ensure the following ECR repositories exist in your AWS account:

- `mautic`
- `mautic-mysql`
- `fargate-examples/simple-php-website`

You can create them using the AWS CLI:

```bash
aws ecr create-repository --repository-name mautic
aws ecr create-repository --repository-name mautic-mysql
aws ecr create-repository --repository-name fargate-examples/simple-php-website
```

## Customization

### AWS Region

The workflow is configured to use the `us-east-1` region. If you want to use a different region, update the `aws-region` parameter in the `Configure AWS credentials` step.

### CloudFormation Parameters

The workflow automatically determines the default VPC and subnets for the CloudFormation templates. If you want to use specific VPC and subnets, update the `Deploy Mautic to AWS Fargate` and `Deploy simple-php-website to AWS Fargate` steps.

### ECR Repository URLs

If you need to use different ECR repository URLs, update the `tags` parameter in the `Build and push` steps and update the CloudFormation templates accordingly.

## Troubleshooting

### Deployment Failures

If the deployment fails, check the CloudFormation events in the AWS Console for more information:

1. Go to the CloudFormation console
2. Select the stack that failed
3. Click on the "Events" tab to see the error messages

### Image Push Failures

If pushing images to ECR fails, ensure that:

1. The ECR repositories exist
2. The IAM role has the necessary permissions to push to ECR
3. The GitHub Actions workflow has the correct permissions to assume the IAM role