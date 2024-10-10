 <!-- Main Content Area -->
 <div class="">
     <div class="header">
         <h1>Welcome, <?php echo ucfirst($_SESSION['role']); ?></h1>
     </div>

     <?php if ($_SESSION['role'] == 'administrator'): ?>
     <!-- Admin View -->
     <div class="dashboard-summary">
         <div class="card">
             <h3>Total Submissions</h3>
             <p>50</p>
         </div>
         <div class="card">
             <h3>Pending Approvals</h3>
             <p>5</p>
         </div>
         <div class="card">
             <h3>Rejected Submissions</h3>
             <p>2</p>
         </div>
         <div class="card">
             <h3>Completed PPAs</h3>
             <p>43</p>
         </div>
     </div>

     <div class="recent-submissions">
         <h2>Recent Submissions</h2>
         <table>
             <thead>
                 <tr>
                     <th>Campus Name</th>
                     <th>Project Name</th>
                     <th>Date Submitted</th>
                     <th>Status</th>
                     <th>Actions</th>
                 </tr>
             </thead>
             <tbody>
                 <?php
                        $submissions = [
                            ['campus' => 'Campus A', 'project' => 'Project 1', 'date' => '2024-10-01', 'status' => 'Pending'],
                            ['campus' => 'Campus B', 'project' => 'Project 2', 'date' => '2024-09-28', 'status' => 'Approved']
                        ];
                        foreach ($submissions as $submission) {
                            echo "<tr>";
                            echo "<td>{$submission['campus']}</td>";
                            echo "<td>{$submission['project']}</td>";
                            echo "<td>{$submission['date']}</td>";
                            echo "<td>{$submission['status']}</td>";
                            echo "<td><button>View</button> <button>Approve</button> <button>Reject</button></td>";
                            echo "</tr>";
                        }
                        ?>
             </tbody>
         </table>
     </div>

     <?php elseif ($_SESSION['role'] == 'coordinator'): ?>
     <!-- Coordinator View -->
     <div class="coordinator-upload">
         <h2>Upload New Document</h2>
         <form action="upload.php" method="post" enctype="multipart/form-data">
             <label for="projectName">Project Name:</label>
             <input type="text" id="projectName" name="projectName" required>

             <label for="description">Description:</label>
             <textarea id="description" name="description" required></textarea>

             <label for="fileUpload">Upload File:</label>
             <input type="file" id="fileUpload" name="fileUpload" required>

             <button type="submit">Submit</button>
         </form>
     </div>

     <div class="recent-submissions">
         <h2>Your Recent Submissions</h2>
         <table>
             <thead>
                 <tr>
                     <th>Project Name</th>
                     <th>Date Submitted</th>
                     <th>Status</th>
                 </tr>
             </thead>
             <tbody>
                 <?php
                        $coordinatorSubmissions = [
                            ['project' => 'Project 1', 'date' => '2024-10-01', 'status' => 'Pending'],
                            ['project' => 'Project 2', 'date' => '2024-09-28', 'status' => 'Approved']
                        ];
                        foreach ($coordinatorSubmissions as $submission) {
                            echo "<tr>";
                            echo "<td>{$submission['project']}</td>";
                            echo "<td>{$submission['date']}</td>";
                            echo "<td>{$submission['status']}</td>";
                            echo "</tr>";
                        }
                        ?>
             </tbody>
         </table>
     </div>

     <?php else: ?>
     <p>Invalid Role</p>
     <?php endif; ?>

 </div>