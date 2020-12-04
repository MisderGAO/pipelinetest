FROM python:3.7
#ENV http_proxy http://proxy-chain.xxx.com:911/
#ENV https_proxy http://proxy-chain.xxx.com:912/ 
RUN mkdir /app
WORKDIR /app
ADD ./app/ /app/
#RUN pip3 install pip --upgrade
RUN pip install --default-timeout=1000 --no-cache-dir -r requirements.txt

# FROM python:3.6.5
# ENV PYTHONUNBUFFERED 1
# RUN mkdir -p /usr/src/app
# WORKDIR /usr/src/app/
# ADD ./app/requirements.txt /usr/src/app/
# RUN pip3 install pip --upgrade
# RUN pip install -r requirements.txt
# RUN apt-get update && apt-get -y install poppler-utils
# ADD ./app/ /usr/src/app

EXPOSE 5000
CMD ["python", "/app/main.py"]
