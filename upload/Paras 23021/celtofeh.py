def ctf(c):
    f=c*(9/5)+32
    return f

if __name__ == '__main__':
    c=input("enter temperature in celcius ")
    c=int(c)
    print("temperature in fahrenhite is %f "%ctf(c))
