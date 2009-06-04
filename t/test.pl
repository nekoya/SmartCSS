#!/usr/bin/perl
use strict;
use warnings;
use utf8;

use Data::Dumper;
use File::Find::Rule;
use Perl6::Say;

my @files = File::Find::Rule->file()->name( qr/^\d\d\-[^\.]+\.php$/ )->in( '.' );
my @errors;
my $detail;
for my $file ( @files ) {
    my $result = `php $file`;
    if ( $result =~ /^not ok (\d+)/m ) {
        push @errors, $file;
        push @{ $detail->{ $file } }, $1;
    }
}

if ( @errors ) {
    say '!!!! Failed tests !!!!';
    for my $file ( @errors ) {
        say $file;
        print "  Filaed test ";
        say join ', ', @{ $detail->{ $file } };
    }
}
