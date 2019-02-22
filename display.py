import sys
import os
from PyQt5.QtWidgets import QWidget, QPushButton, QApplication, QLineEdit
from mitm import *

arp_poison = Arp_poison()

class Main(QWidget):
    
    def __init__(self):
        super().__init__()
        self.initUI()
        
    def initUI(self):

        self.victimIP = QLineEdit(self)
        self.victimIP.move(20, 20)
        self.victimIP.resize(100,20)
        self.victimIP.setPlaceholderText("Victim IP") 

        self.gateIP = QLineEdit(self)
        self.gateIP.move(140, 20)
        self.gateIP.resize(100,20)
        self.gateIP.setPlaceholderText("Gate IP") 
        
        self.interface = QLineEdit(self)
        self.interface.move(260, 20)
        self.interface.resize(100,20)
        self.interface.setPlaceholderText("Interface") 

        def showParams():
            print(self.victimIP.text() + " " + self.gateIP.text() + " " + self.interface.text())

        def start():
            arp_poison.victimIP = self.victimIP.text()
            arp_poison.gateIP = self.gateIP.text()
            arp_poison.interface = self.interface.text()
            arp_poison.enablePoison()

        showParamsBtn = QPushButton('Show', self)
        showParamsBtn.move(380, 20)
        showParamsBtn.resize(50,20)
        showParamsBtn.clicked.connect(showParams)

        startPoisonBtn = QPushButton('StartPoison', self)
        startPoisonBtn.move(20,60)
        startPoisonBtn.resize(100,20)
        startPoisonBtn.clicked.connect(start)
        
        stopPoisonBtn = QPushButton('StopPoison', self)
        stopPoisonBtn.move(140, 60)
        stopPoisonBtn.resize(100,20)
        stopPoisonBtn.clicked.connect(arp_poison.disablePoison)

        exitBtn = QPushButton('Exit', self)
        exitBtn.move(20, 100)
        exitBtn.resize(100,20)
        exitBtn.clicked.connect(self.close)
        
        self.setGeometry(800, 300, 500, 300)
        self.setWindowTitle('Mitm')
        self.show()

if __name__ == '__main__':
    app = QApplication(sys.argv)
    run = Main()
    sys.exit(app.exec_())