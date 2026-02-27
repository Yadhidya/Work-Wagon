package com.backend.work_wagon.Service;

import com.backend.work_wagon.Repository.Shop_Repo;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import com.backend.work_wagon.Model.Shop;
import org.springframework.web.multipart.MultipartFile;

import java.io.IOException;
import java.util.List;

@Service
public class Shop_Service {

    @Autowired
    Shop_Repo repo;


    public List<Shop> getShops() {
        return  repo.findAll();
    }

    public Shop addShop(Shop shop, MultipartFile imageFile) throws IOException {
        shop.setImageName(imageFile.getOriginalFilename());
        shop.setImageType(imageFile.getContentType());
        shop.setImageData(imageFile.getBytes());
        return repo.save(shop);
    }

    public Shop login(String email, String password) {

        Shop shop = repo.findByEmail(email)
                .orElseThrow(() -> new RuntimeException("Invalid email"));

        if (!shop.getPassword().equals(password)) {
            throw new RuntimeException("Invalid password");
        }

        return shop;
    }

    public Shop getById(Integer id) {
        return repo.findById(id)
                .orElseThrow(() -> new RuntimeException("Shop not found"));
    }
}
