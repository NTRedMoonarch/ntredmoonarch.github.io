<div class="">
    <div class="content-area">

        <?php if ($_SESSION['role'] == 'coordinator'): ?>
        <!-- Coordinator View -->
        <h3>Your PPAs</h3>

        <!-- Button to show the modal for adding a new PPA -->
        <button id="addPPAButton">Add New PPA</button>

        <div class="ppa-list">
            <table>
                <thead>
                    <tr>
                        <th>PPA Name</th>
                        <th>Description</th>
                        <th>Required Documents</th>
                        <th>Completion</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Fetching PPAs data from database would replace this static data
                        $ppas = [
                            ["name" => "PPA 1", "description" => "Description for PPA 1", "required_documents" => ["Proposal", "Report"], "completed_documents" => ["Proposal"], "status" => "Ongoing"],
                            ["name" => "PPA 2", "description" => "Description for PPA 2", "required_documents" => ["Proposal", "Photos", "Report"], "completed_documents" => ["Proposal", "Photos", "Report"], "status" => "Completed"],
                        ];

                        foreach ($ppas as $ppa) {
                            $total_docs = count($ppa["required_documents"]);
                            $completed_docs = count($ppa["completed_documents"]);
                            $completion_percentage = ($completed_docs / $total_docs) * 100;
                            $status_class = ($ppa["status"] === "Completed") ? "status-completed" : "status-ongoing";
                        ?>
                    <tr>
                        <td><?= $ppa["name"]; ?></td>
                        <td><?= $ppa["description"]; ?></td>
                        <td><?= implode(", ", $ppa["required_documents"]); ?></td>
                        <td>
                            <div class="completion-bar">
                                <div class="completion-bar-fill" style="width: <?= $completion_percentage; ?>%;"></div>
                            </div>
                            <?= round($completion_percentage, 2); ?>%
                        </td>
                        <td><span class="<?= $status_class; ?>"><?= $ppa["status"]; ?></span></td>
                        <td>
                            <button onclick="editPPA('<?= $ppa['name']; ?>')">Edit</button>
                            <button onclick="deletePPA('<?= $ppa['name']; ?>')">Delete</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Modal for adding a new PPA -->
        <div id="addPPAModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="closeModal()">x</span>
                <h3>Add New PPA</h3>
                <form action="add_ppa.php" method="POST">
                    <div class="form-group">
                        <label for="ppa-name">PPA Name</label>
                        <input type="text" id="ppa-name" name="ppa_name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="required-documents">Required Documents (comma-separated)</label>
                        <input type="text" id="required-documents" name="required_documents"
                            placeholder="E.g., Proposal, Photos, Report" required>
                    </div>
                    <button type="submit">Add PPA</button>
                </form>
            </div>
        </div>

        <script>
        // Modal handling
        var addPPAButton = document.getElementById('addPPAButton');
        var addPPAModal = document.getElementById('addPPAModal');

        addPPAButton.onclick = function() {
            addPPAModal.style.display = "flex";
        }

        function closeModal() {
            addPPAModal.style.display = "none";
        }
        </script>

        <?php elseif ($_SESSION['role'] == 'administrator'): ?>
        <!-- Administrator View -->
        <h3>PPAs by Campus</h3>

        <div class="ppa-list">
            <table>
                <thead>
                    <tr>
                        <th>Campus</th>
                        <th>PPA Name</th>
                        <th>Completion</th>
                        <th>Compliance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Example campuses and PPAs data (replace with database logic)
                        $campuses = [
                            "Campus A" => [
                                ["name" => "PPA 1", "completion" => 75, "compliance" => "High"],
                                ["name" => "PPA 2", "completion" => 100, "compliance" => "Full"],
                            ],
                            "Campus B" => [
                                ["name" => "PPA 3", "completion" => 50, "compliance" => "Medium"],
                                ["name" => "PPA 4", "completion" => 20, "compliance" => "Low"],
                            ]
                        ];

                        foreach ($campuses as $campus => $ppaList) {
                            foreach ($ppaList as $ppa) {
                        ?>
                    <tr>
                        <td><?= $campus; ?></td>
                        <td><?= $ppa["name"]; ?></td>
                        <td><?= $ppa["completion"]; ?>%</td>
                        <td><?= $ppa["compliance"]; ?></td>
                        <td>
                            <button onclick="addDocumentRequirement('<?= $ppa['name']; ?>')">Add Document</button>
                        </td>
                    </tr>
                    <?php }
                        } ?>
                </tbody>
            </table>
        </div>

        <script>
        function addDocumentRequirement(ppaName) {
            alert("Functionality to add document requirement to " + ppaName + " goes here.");
        }
        </script>

        <?php else: ?>
        <p>Access Denied</p>
        <?php endif; ?>

    </div>
</div>