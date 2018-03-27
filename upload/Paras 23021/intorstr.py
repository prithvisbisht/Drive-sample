def isFloat(arg):
    for val in arg:
        if
def check(arg):
    if(arg.isdigit()):
        print("integers doesnt have length")
    elif isFloat(arg):
        print("floats doesnt have length")
    else:
        print(len(arg))



def string_length(mystring):
     if type(mystring) == int:
         return "Sorry, integers don't have length"
     elif type(mystring) == float:
         return "Sorry, floats don't have length"
     else:
         return len(mystring)


if __name__ == '__main__':
    inp=input("enter a string ")
    check(inp)
    # print(string_length(inp))
