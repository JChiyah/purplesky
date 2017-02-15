package dataGenerator;
import java.io.*;
import java.util.*;

public class generateData {
public static void main (String[] args) throws IOException{
	skillgenerate();
	locationgenerate();
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
	FileWriter projectresources= new FileWriter("project_resources.csv");		//project_dashboard format: projectID,text,date(yyyy-mm-dd hh:mm:ss)
	BufferedWriter projectresourcesbw= new BufferedWriter(projectresources);
	FileWriter projectstaff= new FileWriter("project_staff_skills.csv");		//project_staff_skills format: projectID,staffID,skillID
	BufferedWriter projectstaffbw= new BufferedWriter(projectstaff);
	
	
	FileWriter accgroup = new FileWriter("account_group.csv");
	BufferedWriter accgroupbw = new BufferedWriter (accgroup);
	int toGenerate; //Will be input by the user for how many lines they which to generate
	int projectGenerate; //how many projects to generate
	int linecounter= 5; //counter to keep track of how many lines have been generated
	int projectID=0;  //tracker for projects
	int fletter1= 0; //fletter is for the first name letters
	int fletter2= 0;
	int fletter3= 0;
	int fletter4= 0;
	int fletter5= 0;
	int lletter1= 0; //lletter is for the last name letters
	int lletter2= 0;
	int lletter3= 0;
	int lletter4= 0;
	int lletter5= 0;
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
	System.out.println("How many lines of testdata would you like?");
	System.out.println("(Each line contains all the information for 1 account)");
	toGenerate= scanner.nextInt(); //takes in the number of lines to be generated
	if(toGenerate <= 10){ // must be above 10 lines
		System.out.println("To small, please input a number above 10");
		System.exit(1);
	}
	System.out.println("How many projects?");
	projectGenerate=scanner.nextInt();
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
		
		accgroupbw.write("\""+linecounter+"\",\"3\"");
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
		
		
		
		lastname= letter(lletter1)+letter(lletter2)+letter(lletter3)+letter(lletter4)+letter(lletter5); // reused as lastname for accounts
		firstname=letter(fletter1)+letter(fletter2)+letter(fletter3)+letter(fletter4)+letter(fletter5);
		email = firstname + "."+lastname+"@fakeemails.com";
		String toWrite = "\""+email + "\",\""+ip_address + "\",\""+password+"\",\""+forgotpasswordcode+"\",\"1\",\""+firstname+"\",\""+lastname+"\"";
		bw.write(toWrite);
		bw.newLine();
		//experiences table
				int year=2000+rand2.nextInt(16);
				int month=rand2.nextInt(12)+1;
				int day=rand2.nextInt(28)+1;
				int year2=2000+rand2.nextInt(17);
				if(year2<=year) {
					year=2000;
					year2=2000+rand.nextInt(17)+1;}
				int month2=rand2.nextInt(12)+1;
				int day2=+rand2.nextInt(28)+1;
				int rolepos=rand2.nextInt(5);
				
				String titleofexperince= role[rolepos]+" apprentice";
				experiencesbw.write("\""+linecounter+"\",\""+year+"-"+month+"-"+day+"\",\""+year2+"-"+month2+"-"+day2+"\",\""+titleofexperince+ "\",\""+"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus."+"\",\""+role[rolepos]+"\"");
				experiencesbw.newLine();
								
				linecounter++;
				
		if(lletter1 == 25){ //loop for changing one letter each time through the loop
			lletter1 = 0;
			if(lletter2==25){
				lletter2=0;
				if (lletter3== 25){
					lletter3=0;
					if(lletter4==25){
						lletter4=0;
						if(lletter5==25){
							lletter5=0;
							if(fletter1==25){
								fletter1=0;
								if(fletter2==25){
									fletter2=0;
									if(fletter3==25){
										fletter3=0;
										if(fletter4==25){
											fletter4=0;
											if(fletter5==25){
												System.out.println("You have generated as many lines as this program can do, be satisfied with what you got you greedy bugger!");
												bw.close();
												fw.close();
												System.exit(1);
											}
											else if(fletter5<25){
												fletter5++;
											}
										}
										else if(fletter4<25){
											fletter4++;
										}
									}
									else if(fletter3<25){
										fletter3++;
									}
								}
								else if(fletter2<25){
									fletter2++;
								}
							}
							else if(fletter1<25){
								fletter1++;
							}
						}
						else if (lletter5<25){
							lletter5++;
						}
				}
					else if(lletter4<25){
						lletter4++;
					}
				}
				else if(lletter3<25){
					lletter3++;
				}
			}
			else if(lletter2 < 25){
				lletter2++;
			}
			
		
		}
		else if(lletter1<25){
			lletter1++;
		}
	}
	linecounter=5;
	while(linecounter<(projectGenerate+5)){
		lletter1=0;
		lletter2=0;
		lletter3=0;
		lletter4=0;
		lletter5=0;
		lastname= letter(lletter1)+letter(lletter2)+letter(lletter3)+letter(lletter4)+letter(lletter5);
		
		int year=2000+rand2.nextInt(16);
		int month=rand2.nextInt(12)+1;
		int day=rand2.nextInt(28)+1;
		int year2=2000+rand2.nextInt(17);
		if(year2<=year) {
			year=2000;
			year2=2000+rand.nextInt(17)+1;}
		int month2=rand2.nextInt(12)+1;
		int day2=+rand2.nextInt(28)+1;
		// project table
		int prio =rand.nextInt(2);
		int localize= rand.nextInt(5)+1;
		String projectwrite="\""+3+"\",\""+"Project "+lastname+"\",\""+"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus."+"\",\""+prio+"\",\""+localize+"\",\""+(1000+rand.nextInt(2000))+"\",\""+year+"-"+month+"-"+day+"\",\""+year2+"-"+month2+"-"+day2+"\"";
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
		projectresourcesbw.write("\""+projectID+"\",\""+staffing[temp]+"\",\""+role[rand.nextInt(5)]+"\"");
		projectresourcesbw.newLine();
		
		
		//project_staff_skills
		
		//TODO
		int temp2 = staffing[temp];
		projectstaffbw.write("\""+projectID+"\",\""+staffing[temp]+"\",\""+skillarray[temp2]+"\""); //check if it cares if person has skill or not
		projectstaffbw.newLine();
		temp++;
		}
		linecounter++;
		if(lletter1 == 25){ //loop for changing one letter each time through the loop
			lletter1 = 0;			//I know it's ugly
			if(lletter2==25){
				lletter2=0;
				if (lletter3== 25){
					lletter3=0;
					if(lletter4==25){
						lletter4=0;
						if(lletter5==25){
							lletter5=0;
							if(fletter1==25){
								fletter1=0;
								if(fletter2==25){
									fletter2=0;
									if(fletter3==25){
										fletter3=0;
										if(fletter4==25){
											fletter4=0;
											if(fletter5==25){
												System.out.println("You have generated as many lines as this program can do, be satisfied with what you got you greedy bugger!");
												bw.close();
												fw.close();
												System.exit(1);
											}
											else if(fletter5<25){
												fletter5++;
											}
										}
										else if(fletter4<25){
											fletter4++;
										}
									}
									else if(fletter3<25){
										fletter3++;
									}
								}
								else if(fletter2<25){
									fletter2++;
								}
							}
							else if(fletter1<25){
								fletter1++;
							}
						}
						else if (lletter5<25){
							lletter5++;
						}
				}
					else if(lletter4<25){
						lletter4++;
					}
				}
				else if(lletter3<25){
					lletter3++;
				}
			}
			else if(lletter2 < 25){
				lletter2++;
			}
			
		
		}
		else if(lletter1<25){
			lletter1++;
		}
		
		}
	
	
	
	projectstaffbw.close();
	projectstaff.close();
	projectdashbw.close();
	projectdash.close();
	projectresourcesbw.close();
	projectresources.close();
	projectbw.close();
	project.close();
	experiencesbw.close();
	experiences.close();
	staffskillbw.close();
	staffskill.close();
	
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
