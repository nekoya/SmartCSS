#!/usr/bin/perl
use strict;
use warnings;
use utf8;

use Data::Dumper;
use File::Find::Rule;
use Perl6::Say;

my @files = File::Find::Rule->file()->name( qr/^\d\d\-[^\.]+\.php$/ )->in( '.' );
my $errors;
for my $file ( @files ) {
    my $result = `php $file`;
    while ( $result =~ /^not ok (\d+)/gm ) {
        push @{ $errors->{ $file } }, $1;
    }
}

if ( $errors ) {
    say '!!!! Failed tests !!!!';
    for my $file ( keys %{ $errors } ) {
        say $file;
        print "  Failed test ";
        say join ', ', @{ $errors->{ $file } };
    }
} else {
    say 'All test green';
}
