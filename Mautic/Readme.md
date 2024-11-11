## Deploy Mautic to ECS Fargate 

### Prequisites 
- Install AWS CLI and configure AWS Credentials https://docs.aws.amazon.com/cli/v1/userguide/cli-chap-install.html

### To Push image to ECR 
1. Create ECR repository for Mautic as "mautic" name. 
2. `aws ecr get-login-password --region {region} | docker login --username AWS --password-stdin {account_id}.dkr.ecr.us-east-1.amazonaws.com` This command you will get from your ECR service once you create Mautic ECR respository under "View Push Commands". 
3. `docker build -t mautic-local-test .    `
4. `docker tag mautic-local-test:latest {account_id}.dkr.ecr.{region}.amazonaws.com/mautic:latest `
5. `docker push {account_id}.dkr.ecr.{region}.amazonaws.com/mautic:latest`