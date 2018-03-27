#include<iostream>

using namespace std;

struct node{
	string name;
	int age;
	node *next;	
};

class Linkedlist
{
	private:
		node *head,*tail;
	public:
		Linkedlist()
		{
			head=NULL;
			tail=NULL;
		}
		
		void add_node(int age,string name)
    	{
        	node *tmp = new node;
        	tmp->age = age;
        	tmp->name=name;
        	tmp->next = NULL;
        		if(head == NULL)
        		{
            		head = tmp;
            		tail = tmp;
        		}
        	else
        		{
            		tail->next = tmp;
            		tail = tail->next;
        		}
    	}
    	
    	void display()
    	{
    		node *tmp;
    		tmp=head;
    		if(head==NULL)
    		{
    			cout<<"list is empty"<<endl;
    			return;
			}
    		while(tmp!=NULL)
    		{
    			cout<<"name is "<<tmp->name<<" age is "<<tmp->age<<endl;
    			tmp=tmp->next;
			}
		}
		void delet(string name)
		{
			node *tmp;
			tmp=head;
			if(head->name==name)
			{
				head=head->next;
				delete tmp;
				return ;
			}
			while(tmp->next!=NULL)
			{
				if((tmp->next)->name==name)
				{
					node *temp=tmp->next;
					if((tmp->next)->next!=NULL)
						tmp->next=(tmp->next)->next;
					else
					{
						tmp->next=NULL;
						break;
					}
					delete temp;
					
				}
				tmp=tmp->next;
			}
		}
};

int main()
{
	Linkedlist list;
	int a;
	do
	{
		cout<<"MENU"<<endl;
		cout<<"1-insert"<<endl;
		cout<<"2-delete"<<endl;
		cout<<"3-display"<<endl;
		cout<<"Select any option"<<endl;
		int option;
		cin>>option;int age;
		string name;
		switch(option)
		{
			case 1:cout<<"insert name and age of the student"<<endl;
					cin>>name>>age;
					list.add_node(age,name);
					break;
			case 2:cout<<"insert name of the node to be deleted"<<endl;
					cin>>name;
					list.delet(name);
					break;
			case 3: list.display();
					break;
			default: cout<<"Wrong Option"<<endl;
					break;
		}
		cout<<"to use again press 1"<<endl;
		cin>>a;
	}
	while(a==1);
	
}
