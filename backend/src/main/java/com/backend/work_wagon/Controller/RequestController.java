package com.backend.work_wagon.Controller;

import com.backend.work_wagon.DTO.RequestDTO;
import com.backend.work_wagon.Model.Request;
import com.backend.work_wagon.Service.RequestService;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/requests")
@CrossOrigin(origins = "http://localhost:5173", allowCredentials = "true")
public class RequestController {

    @Autowired
    private RequestService service;

    @PostMapping("/send")
    public ResponseEntity<?> sendRequest(@RequestBody RequestDTO dto,
                                         HttpSession session) {
        try {
            Request request = service.sendRequest(dto, session);
            return ResponseEntity.ok(request);
        } catch (Exception e) {
            return ResponseEntity.badRequest().body(e.getMessage());
        }
    }
}