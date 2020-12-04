FROM python:3.7
ENV http_proxy http://proxy-chain.xxx.com:911/
ENV https_proxy http://proxy-chain.xxx.com:912/ 
RUN mkdir /app
WORKDIR /app
ADD ./app/ /app/
#RUN pip3 install pip --upgrade
RUN pip3 install -r requirements.txt

EXPOSE 5000
CMD ["python", "/app/main.py"]
