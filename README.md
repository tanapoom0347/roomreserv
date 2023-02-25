คำสั่ง  
git --version  
ls  
ls -a  
mkdir  
cd  
cd /d/Downloads/Downloads2/coding1/coding/roomreserv/  
git init //ติดตั้งโฟลเดอร์ .git *สำหรับครั้งแรก  
git status /**On Brunch Main และ เช็คไฟล์ Untrack หรือยังไม่ได้ Staged**/ Staged = เตรียมพร้อมขึ้นเวที  
git remote -v  
git remote add origin https://github.com/tanapoom0347/roomreserv.git <!-- add remote ของ GitHub !-->  
git status /** Show Link GitHub **/  
git add . /*add ไฟล์เข้าไปอยู่ใน staged*/  
git commit -m "First Commit" //Commit เซฟลงในเครื่อง และทำการคอมเมนท์  
git log //อ่านค่า Commit และ ชื่อคอมเมนท์  
git push origin main /*** push file ไปยัง Github ***/ จบ  
git clone https://github.com/tanapoom0347/gitrepo.git another_pc_gitrepo //โคลนไฟล์มาโดยให้gitสร้างโฟเดอร์ใหม่กำหนดชื่อเองได้** /ถ้าไม่ใส่ชื่อคือโคลนชื่อrepoเป็นโฟเดอร์ใหม่**  
git clone -b "v1.0" http://git.abc.net/git/abs.git my_abc  
  
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