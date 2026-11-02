from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys

driver = webdriver.Chrome()

driver.get ("http://127.0.0.1:8000/login")

campo_email = driver.find_element(By.ID, "email")
campo_email.send_keys("joao3@gmail.com")

senha = driver.find_element(By.ID, "password")
senha.send_keys("senha1234")
senha.send_keys(Keys.ENTER)

if driver.current_url.endswith (":8000/") : # aqui ele vai olhar pro final da url que será retornada após a tentativa de login

    print("correto")

else:
    print("falha")

input()