import os
from setuptools import setup, find_packages

def read(fname):
    return open(os.path.join(os.path.dirname(__file__), fname)).read()

setup(
    name = 'Hamcrest',
    version = '1.0',
    author = 'Jon Reid',
    maintainer_email = 'hamcrest-dev@googlegroups.com',
    description = 'Hamcrest framework for matcher objects',
    license = 'BSD',
    keywords = 'hamcrest matchers pyunit unit test testing unittest unittesting',
    url = 'http://code.google.com/p/hamcrest/',
    packages = find_packages(),
    test_suite = 'hamcrest-unit-test.alltests',
    provides = ['hamcrest',],
    long_description=read('README'),
    classifiers = [
        'Development Status :: 5 - Production/Stable',
        'Environment :: Console',
        'Intended Audience :: Developers',
        'License :: OSI Approved :: BSD License',
        'Natural Language :: English',
        'Operating System :: OS Independent',
        'Programming Language :: Python :: 2.6',
        'Topic :: Software Development',
        'Topic :: Software Development :: Quality Assurance',
        'Topic :: Software Development :: Testing',
        ],
    )
