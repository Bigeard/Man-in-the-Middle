from scapy.all import *

seq = 12345
sport = 1040
dport = 80

ip_packet = IP(dst='216.58.213.142')
syn_packet = TCP(sport=sport, dport=dport, flags='S', seq=seq)

packet = ip_packet/syn_packet
synack_response = sr1(packet)

next_seq = seq + 1
my_ack = synack_response.seq + 1

ack_packet = TCP(sport=sport, dport=dport, flags='A', seq=next_seq, ack=my_ack)

send(ip_packet/ack_packet)

payload_packet = TCP(sport=sport, dport=dport, flags='A', seq=next_seq, ack=my_ack)
payload = "GET / HTTP/1.0\r\nHOST: 216.58.213.142\r\n\r\n"

reply, error = sr(ip_packet/payload_packet/payload, multi=1, timeout=1)
for r in reply:
    r[0].show2()
    r[1].show2()