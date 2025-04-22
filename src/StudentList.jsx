import axios from './axios';
import './styles/Studentlist.css'

export default function StudentList({ students, fetchStudents, setEditingStudent }) {
  const handleDelete = async (id) => {
    await axios.delete(`/students/${id}`);
    fetchStudents();
  };

  return (
    <div>
      <h2>Students List</h2>
      <ul>
        {students.map((student) => (
          <li key={student.id}>
            {student.name} - {student.email} - {student.age} - {student.major}
            <button onClick={() => setEditingStudent(student)}>Edit</button>
            <button onClick={() => handleDelete(student.id)}>Delete</button>
          </li>
        ))}
      </ul>
    </div>
  );
}
