def min_to_hour(minutes):
    hours = minutes / 60
    return hours

def hour_to_secs(arg):
    return(arg*3600)


a=min_to_hour(70);
print(a)
print(hour_to_secs(1))

# Note that not all functions have one input parameter. There are also simplerfunctions without any parameters at all. Example:
# def say_hello():
#     return "Hello"
