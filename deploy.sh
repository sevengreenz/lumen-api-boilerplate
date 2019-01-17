#/bin/bash

if [ "$1" != 'dev' ] && [ "$1" != 'prd' ];
then
  echo "Invalid argument! Please set one of 'qa' or 'dev' or 'stg' or 'prd'."
  exit 1
fi

# dev or prd
ENV=$1
ECS_CLUSTER_NAME=$ENV-sales
ECS_TASK_NAME=$ENV-sales-api
SUBNET_1a=$ENV-private-1a
SUBNET_1c=$ENV-private-1c
SUBNET_1d=$ENV-private-1d
SECURITY_GROUP=$ENV-sg-container

# docker image ビルド
docker-compose build

# AWS ECR ログイン
$(aws ecr get-login --no-include-email --region ap-northeast-1)

# web イメージのプッシュ
docker tag salesapi_web:latest 761473989327.dkr.ecr.ap-northeast-1.amazonaws.com/sales-api/web:latest
docker push 761473989327.dkr.ecr.ap-northeast-1.amazonaws.com/sales-api/web:latest

# app イメージのプッシュ
docker tag salesapi_app:latest 761473989327.dkr.ecr.ap-northeast-1.amazonaws.com/sales-api/app:latest
docker push 761473989327.dkr.ecr.ap-northeast-1.amazonaws.com/sales-api/app:latest

# TODO: ECS task 実行
#aws ecs run-task \
#  --cluster $ECS_CLUSTER_NAME \
#  --task-definition $ECS_TASK_NAME \
#  --launch-type FARGATE \
#  --network-configuration awsvpcConfiguration={subnets=[subnet-094333f37ed1ef44b,subnet-0de4cb9b4e8f00438,subnet-038a148f1d35d1503],securityGroups=[sg-03ed293c98f8787a7],assignPublicIp=ENABLED}
#  #--network-configuration awsvpcConfiguration={subnets=[$SUBNET_1a,$SUBNET_1c,$SUBNET_1d],securityGroups=[$SECURITY_GROUP],assignPublicIp=DISABLED}}
#  #--network-configuration '{"awsvpcConfiguration":{"subnets":["$SUBNET_1a","$SUBNET_1c","$SUBNET_1d"],"securityGroups":["$SECURITY_GROUP"],"assignPublicIp":"DISABLED"}}'
