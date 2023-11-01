<?php
class SampleDAO
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllSamples()
    {
        $samples = array();

        // Thực hiện truy vấn SQL để lấy danh sách các mẫu từ cơ sở dữ liệu
        $sql = "SELECT sample.id as sample_id, audio.name audio_name, transcript.content FROM sample
                JOIN audio ON sample.audioId = audio.id
                JOIN transcript ON sample.transcriptId = transcript.id";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sample = new Sample($row['sample_id'], $row['audio_name'], $row['content']);
                $samples[] = $sample;
            }
        }

        return $samples;
    }

    public function deleteSample($sampleId)
    {
        $sql = "DELETE FROM sample WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $sampleId);

        if ($stmt->execute()) {
            // Xoá thành công
            return true;
        } else {
            // Xoá không thành công
            return false;
        }
    }
}
?>