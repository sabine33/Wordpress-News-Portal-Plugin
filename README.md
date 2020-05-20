1. Pull the existing repository

git pull https://github.com/anssoftinc/nepameds_plugin.git

2. Create new branch for required files

git checkout -b some_changes

3. make changes in nepameds\inc\ecommerce\forms\components\html
(html and css in same file)
4. push the repository to the github with required message.
git add .
git commit -m "Some changes"

git push origin some_changes

5. Admin will approve the request to merge the existing branch to master branch
6. Repeat the same steps for more changes.

*name of the component must be as per in 
nepameds\inc\ecommerce\forms\components



SSH CLOUD WORKFLOW

1. to generate keys:
ssh-keygen

2. make environment
eval  `ssh-agent`
ssh-add github

3.password

2kBaw45l!5-AXY

4. connect to ssh

ssh -p 7822 techbyte@az1-ss28.a2hosting.com 

5. git remote repo creation for auto_deploy

mkdir ~/git_repos
cd git_repos
git init --bare nepameds_plugin.git
cd nepameds_plugin.git/hooks
nano post-receive
--copy paste following script (change work tree)

#!/bin/bash
while read oldrev newrev ref
do
    # only checking out the master (or whatever branch you would like to deploy)
    if [[ $ref =~ .*/master$ ]];
    then
        echo "Master ref received.  Deploying master branch to production..."
         git --work-tree=~/nepameds.com/wp-content/plugins/nepameds --git-dir=~/git_repos/nepameds_plugin.git checkout -f
    else
        echo "Ref $ref successfully received.  Doing nothing: only the master branch may be deployed on this server."
    fi
done

# end of file


---------------------
chmod +x post-receive

pwd

--remove existing repo if exists
git remote remove production

--add production repo 
git remote add production ssh://techbyte@az1-ss28.a2hosting.com:7822/~/git_repos/nepameds_plugin.git

git add .
git commit -m "your changes"

--for custom brach / most for changes
git branch production
git checkout production
---
git push production master or git push production production
password: 
2kBaw45l!5-AXY

6. Further help


