def cal_age():
    age= input("enter your age")
    new_age=float(age)*365*24*60*60
    return new_age

if __name__ == '__main__':
    age=cal_age()
    print("your age in seconds is %d in seconds"%age)
