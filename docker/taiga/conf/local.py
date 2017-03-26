from .common import *
from .celery import *

MEDIA_URL = "http://127.0.0.1/media/"
STATIC_URL = "http://127.0.0.1/static/"
ADMIN_MEDIA_PREFIX = "http://127.0.0.1/static/admin/"
SITES["front"]["scheme"] = "http"
SITES["front"]["domain"] = "127.0.0.1"

SECRET_KEY = "theveryultratopsecretkey"

DEBUG = False
TEMPLATE_DEBUG = False
PUBLIC_REGISTER_ENABLED = True

DEFAULT_FROM_EMAIL = "no-reply@example.com"
SERVER_EMAIL = DEFAULT_FROM_EMAIL

EMAIL_BACKEND = "django.core.mail.backends.smtp.EmailBackend"
EMAIL_USE_TLS = False
EMAIL_HOST = "127.0.0.1"
EMAIL_PORT = 25

BROKER_URL = 'amqp://guest:guest@localhost:5672//'
CELERY_RESULT_BACKEND = 'redis://localhost:6379/0'
CELERY_ENABLED = True

EVENTS_PUSH_BACKEND = "taiga.events.backends.rabbitmq.EventsPushBackend"
EVENTS_PUSH_BACKEND_OPTIONS = {"url": "amqp://guest:guest@localhost:5672"}
