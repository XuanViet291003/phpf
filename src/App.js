import { useEffect, useState } from 'react';
import axios from './axios';
import StudentForm from './StudentForm';
import StudentList from './StudentList';

function App() {
  const [students, setStudents] = useState([]);
  const [editingStudent, setEditingStudent] = useState(null);

  const fetchStudents = async () => {
    const res = await axios.get('/students');
    setStudents(res.data);
  };

  useEffect(() => {
    fetchStudents();
  }, []);

  return (
    <div className="App">
      <h1>Student Manager</h1>
      <StudentForm fetchStudents={fetchStudents} editingStudent={editingStudent} setEditingStudent={setEditingStudent} />
      <StudentList students={students} fetchStudents={fetchStudents} setEditingStudent={setEditingStudent} />
    </div>
  );
}

export default App;
