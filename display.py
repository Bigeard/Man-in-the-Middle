import sys
import os
from PyQt5.QtWidgets import QWidget, QPushButton, QApplication
from mitm import *

arp_poison = Arp_poison("eth0", "192.168.0.13", "192.168.0.2")

class Main(QWidget):
    
    def __init__(self):
        super().__init__()
        self.initUI()
        
    def initUI(self):
        startPoisonBtn = QPushButton('StartPoison', self)
        startPoisonBtn.move(72,50)
        startPoisonBtn.clicked.connect(arp_poison.enablePoison)
        
        stopPoisonBtn = QPushButton('StopPoison', self)
        stopPoisonBtn.move(72, 100)
        stopPoisonBtn.clicked.connect(arp_poison.disablePoison)

        exitBtn = QPushButton('Exit', self)
        exitBtn.move(72, 150)
        exitBtn.clicked.connect(self.close)
        
        self.getText()
        self.setGeometry(800, 250, 220, 250)
        self.setWindowTitle('Mitm')
        self.show()
        
    def getText(self):
        text, okPressed = QInputDialog.getText(self, "Get text","Your name:", QLineEdit.Normal, "")
        if okPressed and text != '':
            print(text)

if __name__ == '__main__':
    app = QApplication(sys.argv)
    run = Main()
    sys.exit(app.exec_())