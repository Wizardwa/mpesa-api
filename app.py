#!/bin/python3

import json
from flask import Flask,request
import pymysql

app = Flask(__name__)

#connect to mysql
db = pymysql.connect(host='localhost', user='ewaat', password='cyberwiz', database='tieson_sacco')
cursor = db.cursor()



@app.route('/confirmation', methods=['GET','POST'])
def confirmation():
    #Collect data
    data = request.get_json()
    merchantRequestId = data['Body']['stkCallback']['MerchantRequestID']
    checkoutRequestId = data['Body']['stkCallback']['CheckoutRequestID']
    resultCode = data['Body']['stkCallback']['ResultCode']
    resultDesc = data['Body']['stkCallback']['ResultDesc']
    #store in db
    query = "insert into `trans_cancelled` (`merchantreqid`,`checkoutreqid`,`resultcode`,`resultdec`) values (%s,%s,%s,%s)"
    cursor.execute(query, (merchantRequestId,checkoutRequestId,resultCode,resultDesc))
    db.commit()
    print("Transaction details stored successfully!!!")
    return data

#transaction status
@app.route('/TransactionStatus/result/', methods=['GET','POST'])
def trans_res():
    #result
    res = request.get_json()
    print(res)
    return res
    
@app.route('/TransactionStatus/queue/', methods=['GET','POST'])
def trans_timeout():
    #result
    res = request.get_json()
    print(res)
    return res

#b2c
@app.route('/b2c/result', methods=['GET','POST'])
def b2c():
    #result
    res = request.get_json()
    print(res)
    return res

@app.route('/b2c/queue', methods=['GET','POST'])
def b2c_queue():
    data = request.get_json()
    print(data)
    return data