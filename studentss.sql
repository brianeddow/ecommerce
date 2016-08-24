select courses.id as course_id, courses.name, students.id as student_id, students.last_name, students.email from students
left join courses
on courses.id = students.course_id
where courses.id = students.course_id