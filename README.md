คำสั่ง  
git --version  
ls  
ls -a  
ls -al  
mkdir  
cd  
cd /d/Downloads/Downloads2/coding1/coding/roomreserv/  
cd ../another_pc_gitrepo  
  
git config --list --global  
  
git config --global user.name "Your Name"  
git config --global user.email yourEmail@example.com  
  
git config --list  
  
pull = fetch->git diff->merge  
sync = pull -> push  

https://sysadmin.psu.ac.th/2021/12/04/%E0%B8%A7%E0%B8%B4%E0%B8%98%E0%B8%B5-github-clone-%E0%B8%A1%E0%B8%B2%E0%B9%80%E0%B8%89%E0%B8%9E%E0%B8%B2%E0%B8%B0%E0%B8%9A%E0%B8%B2%E0%B8%87-folder/  
https://www.youtube.com/watch?v=VmpZ9cu3IGQ  
https://www.youtube.com/watch?v=6lL5ijLEoZg  
https://download-directory.github.io/  
https://downgit.github.io/#/home  
โคลนเฉพาะFolder  
  
git init //ติดตั้งโฟลเดอร์ .git *สำหรับครั้งแรก  
git status /**On Brunch Main และ เช็คไฟล์ Untrack หรือยังไม่ได้ Staged**/ Staged = เตรียมพร้อมขึ้นเวที  
git remote -v  
git remote add origin https://github.com/tanapoom0347/roomreserv.git <!-- add remote ของ GitHub !-->  
git status /** Show Link GitHub **/  
git add . /*add ไฟล์เข้าไปอยู่ใน staged*/  
https://github.com/git-guides/git-add  
git checkout -b [branchname]  
git push -u origin [branchname]  /* -u ควรใช้กรณีครั้งแรกจะให้ git set-upstream ใช้คำสั่ง fetch,merge,pull,status โดยไม่ต้องใส่ argument แต่เราไม่ต้องใส่ “-u” ทุกครั้ง แค่ใส่ตอนที่เราต้องการกำหนด upstream ก็พอแล้ว ซึ่งส่วนมากก็คือครั้งแรกที่เรา push ของขึ้น repository ครับ  
git commit -m "First Commit" //Commit เซฟลงในเครื่อง และทำการคอมเมนท์  
git log //อ่านค่า Commit และ ชื่อคอมเมนท์  
git log --oneline  
git push --set-upstream origin main  /***  
git push origin main /*** push file ไปยัง Github ***/ จบ  
git clone https://github.com/tanapoom0347/gitrepo.git another_pc_gitrepo //โคลนไฟล์มาโดยให้gitสร้างโฟเดอร์ใหม่กำหนดชื่อเองได้** /ถ้าไม่ใส่ชื่อคือโคลนชื่อrepoเป็นโฟเดอร์ใหม่**  
git clone -b "v1.0" http://git.abc.net/git/abs.git my_abc  
  
/# ดึงความเปลี่ยนแปลงลงมาตรวจสอบ  
git fetch  
  
git log origin/main --oneline  
  
/# นำไฟล์ที่ fetch มา merge  
git merge origin/main  
  
/# Discard การเปลี่ยนแปลง OR Discard Modified  
git restore readme.md  
  
/# ทำการ fetch และ merge ในทีเดียว  
git pull origin main  
  
git add <file_name> // ระบุไฟล์ เช่น git add index.html about.html  
git add . // ทุกไฟล์ที่อยู่ภายใต้ Directory ปัจจุบัน  
git add --all หรือ git add -A // ทุกไฟล์ใน Project  
git add *.html // หลายไฟล์ระบุนามสกุล  
  
----------- Tag ----------------
  
git tag				// Show all tags  
git tag v1.0			// create tag named v1.0  
git tag -d v1.0			// delete tag v1.0  
git checkout v1.0		// load file of tag v1.0  
git push origin v1.0		// push tag v1.0 to origin server  
git push -d origin v1.0		// delete tag v1.0 in origin server  
  
git commit -am "Comment" // commit พร้อมกับ add staged แต่ต้องเป็นไฟล์ที่มีอยู่แล้วเช่น Modified แต่ไม่ใช่ Untracked  
  
https://memo8.com/git-basic-command/        **เว็บรวบรวมคำสั่งgitที่ใช้บ่อย  
  
/# แก้ไขตามต้องการ  
git add . # หรือ add ไฟล์ที่ต้องการ  
git commit --amend --no-edit  
/# ทีนี้ commit สุดท้ายก็จะรวมสิ่งที่แก้ไขไปด้วย  
