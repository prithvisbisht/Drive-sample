def slength(string):
    count=0
    for i in string:
        count+=1
    return count

if __name__ == '__main__':
    str=input("enter any string ")
    print("length of string is %d"%slength(str))
