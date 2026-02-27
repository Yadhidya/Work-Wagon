package com.backend.work_wagon;

import org.springframework.boot.SpringApplication;

public class TestWorkWagonApplication {

	public static void main(String[] args) {
		SpringApplication.from(WorkWagonApplication::main).with(TestcontainersConfiguration.class).run(args);
	}

}
