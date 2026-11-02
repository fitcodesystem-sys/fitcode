from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys

driver = webdriver.Chrome()

driver.get ("http://127.0.0.1:8000/login")

campo_email = driver.find_element(By.ID, "email")
campo_email.send_keys("joao3@email.com")

senha = driver.find_element(By.ID, "password")
senha.send_keys("senha123")
senha.send_keys(Keys.ENTER)

assert "/" in driver.current_url

print("correto")