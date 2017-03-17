from .common import *

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
