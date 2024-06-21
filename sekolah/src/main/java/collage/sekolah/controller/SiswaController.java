package collage.sekolah.controller;

import lombok.AllArgsConstructor;
import collage.sekolah.entity.Siswa;
import collage.sekolah.service.SiswaService;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@CrossOrigin(origins = "*")
@AllArgsConstructor
@RequestMapping(value="api/siswa", consumes = {"*/*"})
public class SiswaController {
    private SiswaService siswaService;

    // build create Siswa REST API
    @PostMapping(consumes = {"*/*"})
    public ResponseEntity<Siswa> createSiswa(@RequestBody Siswa siswa){
        Siswa savedSiswa = siswaService.createSiswa(siswa);
        return new ResponseEntity<>(savedSiswa, HttpStatus.CREATED);
    }

    // build get siswa by id REST API
    // http://localhost:8080/api/siswa/1
    @GetMapping(value="{id}",consumes = {"*/*"})
    public ResponseEntity<Siswa> getSiswaById(@PathVariable("id") Long id){
        Siswa siswa = siswaService.getSiswaById(id);
        return new ResponseEntity<>(siswa, HttpStatus.OK);
    }

    // Build Get All Siswas REST API
    // http://localhost:8080/api/siswa
    @GetMapping(consumes = {"*/*"})
    public ResponseEntity<List<Siswa>> getAllSiswa(){
        List<Siswa> siswa = siswaService.getAllSiswa();
        return new ResponseEntity<>(siswa, HttpStatus.OK);
    }

    // Build Update Siswa REST API
    @PutMapping(value="{id}",consumes = {"*/*"})
    // http://localhost:8080/api/siswa/1
    public ResponseEntity<Siswa> updateSiswa(@PathVariable("id") Long id,
                                           @RequestBody Siswa siswa){
        siswa.setId(id);
        Siswa updatedSiswa = siswaService.updateSiswa(siswa);
        return new ResponseEntity<>(updatedSiswa, HttpStatus.OK);
    }

    // Build Delete Siswa REST API
    @DeleteMapping(value="{id}",consumes = {"*/*"})
    public ResponseEntity<String> deleteSiswa(@PathVariable("id") Long id){
        siswaService.deleteSiswa(id);
        return new ResponseEntity<>("Siswa successfully deleted!", HttpStatus.OK);
    }
}
