from .development import *

#########################################
## GENERIC
#########################################

#DEBUG = False

#ADMINS = (
#    ("Admin", "example@example.com"),
#)

DATABASES = {
    'default': {
        'ENGINE': 'django.db.backends.postgresql',
        'NAME': 'taiga',
        'USER': 'taiga',
        'PASSWORD': 'Taiga_Database_User_95',
        'HOST': '',
        'PORT': '',
    }
}
