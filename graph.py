import matplotlib.pyplot as plt
import sys

# Get the student name and attendance data from command-line arguments
student_name = sys.argv[1]
attendance_data = list(map(int, sys.argv[2].split(',')))

# Get the x-axis dates from the main table in the database
x_axis_dates = ["2023-04-26", "2023-04-27", "2023-04-28"]  # Replace with your database query or data retrieval method

# Generate the attendance graph
dates = range(1, len(attendance_data) + 1)

plt.plot(dates, attendance_data)
plt.title(f"Attendance Graph for {student_name}")
plt.xlabel("Date")
plt.ylabel("Attendance Count")
plt.xticks(dates, x_axis_dates)  # Set the x-axis ticks to the database dates
plt.savefig("attendance_graph.png")
