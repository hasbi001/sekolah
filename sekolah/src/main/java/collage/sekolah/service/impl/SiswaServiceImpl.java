package collage.sekolah.service.impl;

import lombok.AllArgsConstructor;
import collage.sekolah.entity.Siswa;
import collage.sekolah.repository.SiswaRepository;
import collage.sekolah.service.SiswaService;
import org.apache.logging.log4j.util.Strings;
import org.springframework.stereotype.Service;
import org.springframework.util.StringUtils;

import java.util.List;
import java.util.Objects;
import java.util.Optional;

@Service
@AllArgsConstructor
public class SiswaServiceImpl implements SiswaService {
    private SiswaRepository siswaRepository;

    @Override
    public Siswa createSiswa(Siswa siswa) {
        return siswaRepository.save(siswa);
    }

    @Override
    public Siswa getSiswaById(Long id) {
        Optional<Siswa> optionaSiswa = siswaRepository.findById(id);
        return optionaSiswa.get();
    }

    @Override
    public List<Siswa> getAllSiswa() {
        return siswaRepository.findAll();
    }

    @Override
    public Siswa updateSiswa(Siswa siswa) {
        Siswa existingSiswa = siswaRepository.findById(siswa.getId()).get();
        existingSiswa.setFullName(siswa.getFullName());
        existingSiswa.setKelas(siswa.getKelas());
        existingSiswa.setAlamat(siswa.getAlamat());
        existingSiswa.setWalimurid(siswa.getWalimurid());
        existingSiswa.setWalikelas(siswa.getWalikelas());
        Siswa updatedSiswa = siswaRepository.save(existingSiswa);
        return updatedSiswa;
    }

    @Override
    public void deleteSiswa(Long id) {
        siswaRepository.deleteById(id);
    }
}
