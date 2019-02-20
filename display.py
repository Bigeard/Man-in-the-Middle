import sys
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
        spoofer = ARPSpoof(["0.0.0.0", "0.0.0.0"], "eth0")
        spoofer.run()

    def func2(self):
        print('2')
        
if __name__ == '__main__':
    
    app = QApplication(sys.argv)
    run = Main()
    sys.exit(app.exec_())