<?php
class Filethis_Dispatch {
    public function find($id) {
        $sql = 'select id,from_num,timestamp,audio_url,transcription '.
            'from dispatch where id = ? limit 1';
        return Rudb::get_one($sql,$id);
    }

    public function create($num,$audio_url,$transcript) {
        $sql = 'insert into dispatch (from_num,audio_url,transcript) '.
            'values (?,?,?)';
        $newid = false;
        if(Rudb::query($sql,$num,$audio_url,$transcript)) {
            $newid = Rudb::last_insert_id('dispatch_id_seq');
        }
        return $newid;
    }

    public static function update($id,$num,$audio_url,$transcript) {
        $sql = 'update dispatch set from_num=?, audio_url=?, transcript=? where id=?';
        return Rudb::query($sql,$num,$audio_url,$transcript,$id) {
    }

    public static function delete($id) {
        $sql = 'delete from dispatch where id=?';
        return Rudb::query($sql,$id);
    }
}
