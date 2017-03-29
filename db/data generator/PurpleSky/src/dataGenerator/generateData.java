package dataGenerator;
import java.io.*;
import java.util.*;

public class generateData {
public static void main (String[] args) throws IOException{
	skillgenerate();
	locationgenerate();
	int checkingthis=0;
	int maxprojects=0;
	int lastnamesposition=0;
	int firstnamesposition=0;
	String[] firstnames={"Mary","Patricia","Linda","Barbara","Elizabeth","Jennifer","Maria","Susan","Margaret","Dorothy","Lisa","Nancy","Karen","Betty","Helen","Sandra","Donna","Carol","Ruth","Sharon","Michelle","Laura","Sarah","Kimberly","Deborah","Jessica","Shirley","Cynthia","Angela","Melissa","Brenda","Amy","Anna","Rebecca","Virginia","Kathleen","Pamela","Martha","Debra","Amanda","Stephanie","Carolyn","Christine","Marie","Janet","Catherine","Frances","Ann","Joyce","Diane","Alice","Julie", "Heather","Teresa","Doris","Gloria","Evelyn","Jean","Cheryl","Mildred","Katherine","Joan","Ashley","Judith","Rose","Janice","Kelly","Nicole","Judy","Christina","Kathy","Theresa","Beverly","Denise","Tammy","Irene","Jane","Lori","Rachel","Marilyn","Andrea","Kathryn","Louise","Sara","Anne","Jaqueline","Wanda","Bonnie","Julia","Ruby","Lois","Tina","Phyllis","Norma","Paula","Diana","Annie","Lillian","Emily","Robin","Peggy","Crystal","Gladys","Rita","Dawn","Connie","Florence","Tracy","Edna","Tiffany","Carmen","Rosa","Cindy","Grace","Wendy","Victoria","Edith","Kim","Sherry","Sylvia","Josephine","Thelma","Shannon","Sheila","Ethel","Ellen","Elaine","Marjorite","Carrie","Charlotte","Monica","Esther","Pauline","Emma","Juanita","Anita","Rhonda","Hazel","Amber","Debbie","April","Leslie","Clara","Lucille","Jamie","Joanne","Eleanor","Valerie","Danielle","Megan","Alicia","James","John","Robert","Michael","William","David","Richard","Charles","Joseph","Thomas","Christopher","Daniel","Paul","Mark","Donald","George","Kenneth","Steven","Edward","Brian","Ronald","Anthony","Kevin","Jason","Matthew","Gary","Timothy","Jose","Larry","Jeffrey","Frank","Scott","Eric","Stephen","Andrew","Raymond","Gregory","Joshua","Jerry","Dennis","Walter","Patric","Peter","Peter","Harold","Douglas","Henry","Carl","Arthur","Ryan","Roger","Joe","Juan","Jack","Albert","Jonathan","Justin","Terry","Gerald","Keith","Samuel","Willie","Ralph","Lawrence","Nicholas","Roy","Benjamin","Bruce","Brandon","Adam","Harry","Fred","Wayne","Billy","Steve","Jeremy","Aaron","Randy","Howard","Eugene","Carlos","Russel","Bobby","Victor","Martin","Ernest","Phillip","Todd","Jesse","Craig","Alan","Shawn","Clarence","Sean","Philip","Chris","Johnny","Earl","Jimmy","Antonio","Danny","Bryan","Tony","Luis","Mike","Stanley","Leonard","Nathan","Dale","Manuel","Rodney","Curtis","Norman","Allen","Marvin","Vincent","Glenn","Jeffery","Travis","Jeff","Chad","Jacob","Lee","Melvin","Alfred","Kyle","Francis","Bradley","Jesus","Herbert","Frederick","Ray","Joel","Edwin","Don","Eddie","Ricky","Troy","Randall","Barry","Alexander","Bernard","Mario","Leroy","Francisco","Marcus","Micheal","Theodore","Clifford","Miguel","Oscar","Jay","Jim","Tom","Calvin" };
	
	String[] lastnames= {"Smith","Johnson","Williams","Drumpf","Brown","Jones","Miller","Davis","Garcia","Rodriguez","Wilson","Martinez","Anderson","Taylor","Thomas","Hernandez","Moore","Martin","Jackson","Thompson","White","Lopez","Lee","Gonzalez","Harris","Clark","Lewis","Robinson","Walker","Perez","Hall","Young","Allen","Sanchez","Wright","King","Scott","Green","Baker","Adams","Nelson","Hill","Ramirez","Campbell","Mitchell","Roberts","Carter","Phillips","Evans","Turner","Torres","Parker","Collins","Edwards","Stewart","Flores","Morris","Nguyen","Murphy","Rivera","Cook","Rogers","Morgan","Peterson","Cooper","Reed","Bailey","Bell","Gomez","Kelly","Howard","Ward","Cox","Diaz","Richardson","Wood","Watson","Brooks","Bennett","Gray","James","Reyes","Cruz","Hughes","Price","Myers","Long","Foster","Sanders","Ross","Morales","Powell","Sullivan","Russel","Ortiz","Jenkins","Gutierezz","Perry","Butler","Barnes","Fisher","Henderson","Coleman","Simmons","Patterson","Jordan","Reynolds","Hamilton","Graham","Kim","Gonzales","Alexander","Ramos","Wallace","Griffin","West","Cole","Hayes","Chavez","Gibson","Bryant","Ellis","Murray","Ford","Stevens","Marshall","Owens","McDonald","Harrison","Ruiz","Kennedy","Wells","Alvarez","Woods","Mendoza","Castillo","Olson","Webb","Washington","Tucker","Freeman","Burns","Henry","Vasquez","Snyder","Simpson","Crawford","Jimenez","Porter","Mason","Shaw","Gordon","Wagner","Hunter","Romero","Hicks","Dixon","Hunt","Palmer","Robertson","Black","Holmes","Stone","Meyer","Boyd","Mills","Warren","Fox","Rose","Rice","Moreno","Schmidt","Patel","Ferguson","Nichols","Herrera","Medina","Ryan","Fernandez","Weaver","Daniels","Stephens","Gardner","Payne","Kelley","Dunn","Pierce","Arnold","Tran","Spencer","Peters","Peters","Hawkins","Grant","Hansen","Castro","Hoffman","Hart","Elliott","Cunningham","Knight","Bradley","Carroll","Hudson","Duncan","Armstrong","Berry","Andrews","Johnston","Ray","Lane","Riley","Carpenter","Perkins","Aguilar","Silva","Richards","Willis","Matthews","Chapman","Lawrence","Garza","Vargas","Watkins","Wheeler","Larson","Carlson","Harper","George","Greene","Burke","Guzman","Morrison","Munoz","Jacobs","Obrien","Lawson","Franklin","Lynch","Bishop","Carr","Salazar","Austin","Mendez","Gilbert","Jensen","Williamson","Montgomery","Harvey","Oliver","Howell","Dean","Hanson","Weber","Garrett","Sims","Burton","Fuller","Soto","McCoy","Welch","Chen","Schultz","Walters","Reid","Fields","Walsh","Little","Fowler","Bowman","Davidson","May","Day","Schneider","Newman","Brewer","Lucas","Holland","Wong","Banks","Santos","Curtis","Pearson","Delgado","Valdez","Pena","Rios","Douglas","Sandoval","Barret","Hopkins","Keller","Guerrero","Stanley","Bates","Alvarado","Beck","Ortega","Wade","Estrada","Contreras","Barnertt","Caldwell","Santiago","Lambert","Powers","Chambers","Nunez","Craig","Leonard" };
	String[] projectnames ={"Alpha","Absolute","Always","Beta","Bravo","Butch","Charlie","Charlotte","Charisma","Delta","Denver","Davos","Echo","Eld","Eldorado","Foxtrott","Fabulous","Favour","Gamma","Gold","Graph","Hotel","Helo","Half","India","Indoors","Impolding","Juliett","Jason","Jubilie","Kilo","Key","King","Lima","Lazy","Lavender","Mike","Melon","Mask","November","Native","Naive","Oscar","Ontop","Over","Papa","Perilous","Paper","Quebec","Quantized","Quitter","Romeo","Robust","Race","Sierra","Seller","Safety","Tango","Tail","Tank","Uniform","Ultra","Upside","Victor","Valley","Value","Whiskey","Wall","Wallet","Xray","Xenon","Yankee","Yellow","Yard","Zulu","Zoo","Zap"};
	checkingthis=firstnames.length*lastnames.length;
	maxprojects=projectnames.length*projectnames.length;
	Random rand = new Random();
	Random rand2=new Random();
	Random randstaff=new Random();
	String[] role = new String[5];
	int[] skillarray= new int[100000];
	role[0]= "Programer";
	role[1]="Marketing";
	role[2]="Designer";
	role[3]="Cleaner";
	role[4]="Electrician";
	// format: `email`, `ip_address`, `password`, `salt`, `forgotten_password_code`, `last_login`, `active`, `first_name`, `last_name`
	Scanner scanner = new Scanner(System.in);
	FileWriter fw = new FileWriter("account.csv");	//account table writer
	BufferedWriter bw= new BufferedWriter(fw);
	FileWriter staff = new FileWriter("staff.csv");	//staff writer
	BufferedWriter staffbw= new BufferedWriter(staff);
	FileWriter staffskill = new FileWriter("staff_skill.csv"); //staff skill writer
	BufferedWriter staffskillbw= new BufferedWriter(staffskill);
	FileWriter experiences = new FileWriter("experiences.csv"); //staff experiences format: staffID,start date (yyyy-mm-dd),end date, description, role
	BufferedWriter experiencesbw= new BufferedWriter(experiences);
	FileWriter project= new FileWriter("project.csv");		//project format: managerID, title, description, priority(1/0), location, start,end
	BufferedWriter projectbw= new BufferedWriter(project);
	FileWriter projectdash= new FileWriter("project_dashboard.csv");		//project_dashboard format: projectID,text,date(yyyy-mm-dd hh:mm:ss)
	BufferedWriter projectdashbw= new BufferedWriter(projectdash);
	FileWriter projectstaff= new FileWriter("project_staff.csv");		//project_staff format: projectID,staffID,role,assigned at (yyyy-mm-dd hh:mm:ss),start date, end date,skillID
	BufferedWriter projectstaffbw= new BufferedWriter(projectstaff);
	FileWriter availability = new FileWriter("availability.csv");		//availability format:staffID, startdate, end date, type(1 work, 0 holiday)
	BufferedWriter availabilitybw = new BufferedWriter(availability);
	FileWriter activity = new FileWriter("activity.csv");		//activity format:activityID, accountID, date time (yyyy-mm-dd hh:mm:ss)
	BufferedWriter activitybw = new BufferedWriter(activity);
	
	
	FileWriter accgroup = new FileWriter("account_group.csv");
	BufferedWriter accgroupbw = new BufferedWriter (accgroup);
	int toGenerate; //Will be input by the user for how many lines they which to generate
	int projectGenerate; //how many projects to generate
	int linecounter= 5; //counter to keep track of how many lines have been generated
	int projectID=0;  //tracker for projects

	int pay = 5;
	int location = 1;
	int skillcount=1;
	int skillcount2=1;
	String firstname; 
	String lastname;
	String email;
	String ip_address = "127.0.0.1";
	String forgotpasswordcode =" ";
	String password = "$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36"; //the password for each line will be the same
	System.out.println("How many lines of testdata would you like? (Maximum "+checkingthis + ")");
	System.out.println("(Each line contains all the information for 1 account)");
	toGenerate= scanner.nextInt(); //takes in the number of lines to be generated
	if(toGenerate <= 10){ // must be above 10 lines
		System.out.println("To small, please input a number above 10");
		System.exit(1);
	}
	if(toGenerate >checkingthis){
		System.out.println("To many, next time use less");
		System.exit(1);
	}
	System.out.println("How many projects? (Max "+maxprojects +")");
	projectGenerate=scanner.nextInt();
	if(projectGenerate >maxprojects){
		System.out.println("To many, less next time");
		System.exit(1);
	}
	bw.write("\"admin@admin.com\",\"127.0.0.1\",\"$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36\",\" \",\"1\",\"Super\",\"Admin\"");
	bw.newLine();
	accgroupbw.write("\"1\",\"1\"");
	accgroupbw.newLine();
	
	
	bw.write("\"employee@employee.com\",\"127.0.0.1\",\"$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36\",\" \",\"1\",\"Normal\",\"Employee\"");
	bw.newLine();
	accgroupbw.write("\"2\",\"3\"");
	accgroupbw.newLine();
	staffbw.write("\""+2 +"\",\""+location + "\",\""+ pay+"\"");
	staffbw.newLine();
	
	bw.write("\"donald.d@gmail.com\",\"127.0.0.1\",\"$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36\",\" \",\"1\",\"Donald\",\"Duck\"");
	bw.newLine();
	accgroupbw.write("\"3\",\"2\"");
	accgroupbw.newLine();
	
	bw.write("\"contractor@contractor.com\",\"127.0.0.1\",\"$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36\",\" \",\"1\",\"Normal\",\"Contractor\"");
	bw.newLine();
	accgroupbw.write("\"4\",\"4\"");
	accgroupbw.newLine();
	staffbw.write("\""+4 +"\",\""+location + "\",\""+ pay+"\"");
	staffbw.newLine();
	
	while(linecounter <= (toGenerate+5)){
		//availability format:staffID, startdate, end date, type(1 work, 0 holiday)
		int month=rand2.nextInt(12)+1;
		int day=rand2.nextInt(28)+1;
		int month2=rand2.nextInt(12)+1;
		int day2=rand2.nextInt(28)+1;
		if(month >month2){
			month=1;
		}
		if(month == month2){
			if(day>day2){
				day=1;
				day2=10;
			}
		}
		availabilitybw.write("\""+linecounter+"\",\""+"2017-"+month+"-"+day+"\",\""+"2017-"+month2+"-"+day2+"\",\""+"1"+"\"");
		availabilitybw.newLine();
		//staff generation
		skillcount= rand.nextInt(10)+1;
		staffskillbw.write("\""+linecounter+"\",\""+ skillcount+"\",\"0\"");
		staffskillbw.newLine();
		skillcount2=rand.nextInt(10)+1;
		if(skillcount== skillcount2){
			skillcount2++;
			if (skillcount2==11){
				skillcount2=1;
			}
		}
		if(skillcount>=11)skillcount=1;
		skillarray[linecounter]=skillcount;
		staffskillbw.write("\""+linecounter+"\",\""+ skillcount2+"\",\"0\"");
		staffskillbw.newLine();
		int accaccess=3;
		accaccess=rand.nextInt(2)+1;
		if(accaccess==1){
			accaccess=3;
		}
		if(accaccess==2){
			accaccess=4;
		}
		accgroupbw.write("\""+linecounter+"\",\""+accaccess+"\"");
		accgroupbw.newLine();
		staffbw.write("\""+linecounter +"\",\""+location + "\",\""+ pay+"\"");
		staffbw.newLine();
		if(pay == 95){
			pay = 5;
		}
		if(pay < 95){
			pay=pay + 5;
		}
		if(location == 5){
			location=1;
		}
		if(location < 5){
			location++;
		}
		
		
		firstname=firstnames[firstnamesposition];
		lastname= lastnames[lastnamesposition]; // reused as lastname for accounts
		firstnamesposition++;
		if(firstnamesposition>=firstnames.length){
			firstnamesposition=0;
			lastnamesposition++;
			if(lastnamesposition>=lastnames.length){
				System.out.println("error:to many lines attempted");
				System.exit(1);
			}
		}
		email = firstname + "."+lastname+"@fakeemails.com";
		String toWrite = "\""+email + "\",\""+ip_address + "\",\""+password+"\",\""+forgotpasswordcode+"\",\"1\",\""+firstname+"\",\""+lastname+"\"";
		bw.write(toWrite);
		bw.newLine();
		
		//activity format:activityID, accountID, date time (yyyy-mm-dd hh:mm:ss)
		activitybw.write("\""+linecounter+"\",\""+"Welcome to People+!"+"\",\""+"2017-03-25 00:00:00"+"\"");
		activitybw.newLine();
		activitybw.write("\""+linecounter+"\",\""+"Don't forget to add information to your profile!"+"\",\""+"2017-03-25 00:00:01"+"\"");
		activitybw.newLine();
		//experiences table
				int year=2000+rand2.nextInt(16);
				month=rand2.nextInt(12)+1;
				day=rand2.nextInt(28)+1;
				int year2=2000+rand2.nextInt(17);
				if(year2<=year) {
					year=2000;
					year2=2000+rand.nextInt(17)+1;}
				month2=rand2.nextInt(12)+1;
				day2=+rand2.nextInt(28)+1;
				int rolepos=rand2.nextInt(5);
				
				String titleofexperince= role[rolepos]+" apprentice";
				experiencesbw.write("\""+linecounter+"\",\""+year+"-"+month+"-"+day+"\",\""+year2+"-"+month2+"-"+day2+"\",\""+titleofexperince+ "\",\""+"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero."+"\",\""+role[rolepos]+"\",\""+skillarray[linecounter]+"\"");
				experiencesbw.newLine();
								
				linecounter++;
				
		
	}
	linecounter=5;
	String projectname;
	int projectnamesposition1=0;
	int projectnamesposition2=0;
	while(linecounter<(projectGenerate+5)){
		
		projectname= projectnames[projectnamesposition1]+" "+projectnames[projectnamesposition2];
		projectnamesposition1++;
		if(projectnamesposition1>=projectnames.length){
			projectnamesposition2++;
			projectnamesposition1=0;
			if(projectnamesposition2>=projectnames.length){
				System.out.println("To many projects attempted");
				System.exit(1);
			}
		}
		int year=2000+rand2.nextInt(17);
		if(year < 2013){
			year= 2017;
		}
		int month=rand2.nextInt(12)+1;
		int day=rand2.nextInt(28)+1;
		int year2=2000+rand2.nextInt(17);
		if(year2<=year) {
			year=2000;
			year2=2000+rand.nextInt(18)+1;}
		int month2=rand2.nextInt(12)+1;
			if(month2 >= month){
				month=4;
				month2=7;
			}
		int day2=+rand2.nextInt(28)+1;
		// project table
		int prio =rand.nextInt(2);
		int localize= rand.nextInt(5)+1;
		int projectstatus=2;
		int projectapplications=2;
		//TODO
		if(year<2017){
			projectstatus=rand.nextInt(5)+2;
		}
		
		String projectwrite="\""+3+"\",\""+projectname+"\",\""+"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus."+"\",\""+prio+"\",\""+localize+"\",\""+(10000+rand.nextInt(5000))+"\",\""+year+"-"+month+"-"+day+"\",\""+year2+"-"+month2+"-"+day2+"\",\""+projectstatus+"\",\""+projectapplications+"\"";
		projectID++;
		projectbw.write(projectwrite);
		projectbw.newLine();
		
		// project_dashboard
		int hour = rand.nextInt(23);
		int min = rand.nextInt(59);
		int sec = rand.nextInt(59);
		projectdashbw.write("\""+projectID+"\",\""+"Video provides a powerful way to help you prove your point. When you click Online Video, you can paste in the embed code for the video you want to add. You can also type a keyword to search online for the video that best fits your document."+"\",\""+year+"-"+month+"-"+day+" "+hour+":"+min+":"+sec+"\"");
		projectdashbw.newLine();
		projectdashbw.write("\""+projectID+"\",\""+"To make your document look professionally produced, Word provides header, footer, cover page, and text box designs that complement each other. For example, you can add a matching cover page, header, and sidebar. Click Insert and then choose the elements you want from the different galleries."+"\",\""+year+"-"+month+"-"+day+" "+hour+":"+min+":"+sec+"\"");
		projectdashbw.newLine();
		
		//project_resources
		int staffnumbers=rand.nextInt(10)+1;
		int temp=0;
		int staffing[]=new int[11];
		while(temp<staffnumbers){
		staffing[temp]=	randstaff.nextInt(toGenerate)+5;
		for(int i=0; i<temp;i++){
			if (staffing[temp]==staffing[i]){
				i=0;
				staffing[temp]++;
			}
		}
		
		//project_staff projectID,staffID,role,assigned at (yyyy-mm-dd hh:mm:ss),start date, end date,skillID
		
		
		int temp2 = staffing[temp];
		month=rand.nextInt(3)+1;
		int month3=rand2.nextInt(12)+1;
		if (month3 <=3 ){
			month3=4;
		}
		if(month2>=month){
			month=1;
			month2=2;
		}
		if(month3 <=month2){
			month=1;
			month2=2;
			month3=3;
		}
		projectstaffbw.write("\""+projectID+"\",\""+staffing[temp]+"\",\""+role[rand.nextInt(5)]+"\",\""+"2017-"+month+"-"+day+" 00:00:00"+"\",\""+"2017-"+month2+"-"+day2+"\",\""+"2017-"+month3+"-"+day2+"\",\""+skillarray[temp2]+"\""); //check if it cares if person has skill or not
		projectstaffbw.newLine();
		temp++;
		
		}
		linecounter++;
		
		
		}
	
	
	
	projectstaffbw.close();
	projectstaff.close();
	projectdashbw.close();
	projectdash.close();
	projectbw.close();
	project.close();
	experiencesbw.close();
	experiences.close();
	staffskillbw.close();
	staffskill.close();
	
	activitybw.close();
	activity.close();
	availabilitybw.close();
	availability.close();
	staffbw.close();
	staff.close();
	
	accgroupbw.close();
	accgroup.close();
	bw.close();
	fw.close();
	System.out.println("All lines have been generated");
	System.exit(1);
}

public static void locationgenerate () throws IOException{
	FileWriter temp = new FileWriter("location.csv");
	BufferedWriter tempw= new BufferedWriter(temp);
	
	tempw.write("\"Edinburgh\"");
	tempw.newLine();
	tempw.write("\"Glasgow\"");
	tempw.newLine();
	tempw.write("\"London\"");
	tempw.newLine();
	tempw.write("\"Berlin\"");
	tempw.newLine();
	tempw.write("\"Austin\"");
	
	tempw.close();
	temp.close();
}
public static void skillgenerate() throws IOException{
	FileWriter temp = new FileWriter("skill.csv");
	BufferedWriter tempw= new BufferedWriter(temp);
	
	tempw.write("\"Java\",\"0\"");
	tempw.newLine();
	tempw.write("\"CSS\",\"0\"");
	tempw.newLine();
	tempw.write("\"HTML\",\"0\"");
	tempw.newLine();
	tempw.write("\"PHP\",\"0\"");
	tempw.newLine();
	tempw.write("\"C#\",\"0\"");
	tempw.newLine();
	tempw.write("\"C++\",\"0\"");
	tempw.newLine();
	tempw.write("\"Verilog\",\"0\"");
	tempw.newLine();
	tempw.write("\"Matlab\",\"0\"");
	tempw.newLine();
	tempw.write("\"Electronics\",\"0\"");
	tempw.newLine();
	tempw.write("\"MySQL\",\"0\"");
	tempw.newLine();
	tempw.close();
	temp.close();
}


//Which letter to use
public static String letter (int x){
	if(x==0) return "a";
	else if(x==1) return "b";
	else if(x==2) return "c";
	else if(x==3) return "d";
	else if(x==4) return "e";
	else if(x==5) return "f";
	else if(x==6) return "g";
	else if(x==7) return "h";
	else if(x==8) return "i";
	else if(x==9) return "j";
	else if(x==10) return "k";
	else if(x==11) return "l";
	else if(x==12) return "m";
	else if(x==13) return "n";
	else if(x==14) return "o";
	else if(x==15) return "p";
	else if(x==16) return "q";
	else if(x==17) return "r";
	else if(x==18) return "s";
	else if(x==19) return "t";
	else if(x==20) return "u";
	else if(x==21) return "v";
	else if(x==22) return "w";
	else if(x==23) return "x";
	else if(x==24) return "y";
	else if(x==25) return "z";
	System.out.println("ERROR OUT OF BOUNDS");
	return null;		
}
}
