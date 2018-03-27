#include<iostream>
#include<fstream>
using namespace std;

int main()
{
	ifstream file;
	file.open("input.dat");
	if(!file)
	{
		cout<<"There was some error reading the file, please check if file is there in same directory or if file exists"<<endl;
		exit(0);
	}
	string name;
	int sub1,sub2,sub3;
	while(!file.eof())//loop ends when end of file is encountered
	{
		file>>name>>sub1>>sub2>>sub3;
		//cout<<name<<" "<<sub1<<" "<<sub2<<" "<<sub3<<endl;  //to check if input is taken correctly
		float total=sub1+sub2+sub3;
		float percent=total/3;
		cout<<"Name of Student : "<<name<<"\t"<<"Total Marks: "<<total<<"\t"<<"Total Percent: "<<percent<<"\n";
	}
}
