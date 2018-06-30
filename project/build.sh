#!/bin/bash

mkdir dist;
echo "Install packages..";
npm i;
gulp -v;
echo "Building gulp..";
gulp build;
echo "Copying some data to dist...";
cp -r docs dist/;
cp -r images dist/;

