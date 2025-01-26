# Docker Demo #

Start by updating the remote url to your own repo:
```shell
git remote set-url origin https://your-git-repo/new-repository.git
```
Push it and check GitHub.
```shell
git push
```
After opening one of the starter branches, view the README for further instructions.


## Starter Branches
### PHP Demo
```shell
git checkout php-starter
```

### WordPress Demo
```shell
git checkout wp-starter
```

### WordPress Author Site
```shell
git checkout wp-author-site
```

## To get updates
1. Add the remote, call it "upstream":
   ```shell
   git remote add upstream https://github.com/tylerkowalchuk/docker-dock-it.git
   ```

2. Fetch all the branches of that remote into remote-tracking branches
   ```shell
   git fetch upstream
   ```

3. Make sure that you're on your branch (replace \_\_branchname\_\_ with the branch name):
   ```shell
   git checkout __branchname__
   ```

4. Rewrite your main branch so that any commits of yours that aren't already in upstream/main are replayed on top of that other branch:
   ```shell
   git rebase upstream/__branchname__
   ```