#!/usr/bin/perl

use v5.10;
no warnings;
no strict;

my $verbose = 0;

my $xgettext_bin="/usr/bin/xgettext";
my $xgettext_args="--no-location --force-po --sort-by-file";
my $msgmerge_bin="/usr/bin/msgmerge";
my $msgmerge_args=" --update --backup none --sort-output";
my $msgfmt_bin="/usr/bin/msgfmt";
my $msgfmt_args="";

# Assuming is stored at application/bin/
my $base_path = "./";

# All excluded paths are prefixed with base_path
my @exclude_path = (
    "public",
    "e2e",
    "application/configs/klearRaw",
    "library/vendor",
);

my @keywords = (
    "_",
    "gettext",
    "gettext_noop",
    "translate",
    "plural:1,2"
);

my %extensions = (
    "php"     => "PHP",
    "phtml"   => "PHP",
    "py"      => "Python",
    "yaml"    => "Python",
    "js"      => "JavaScript"
);

my @locales = (
    "es_ES",
    "ca_ES",
    "en_US",
    "it_IT",
);

sub extract_strings
{
    my $extension = shift;
    my $language = $extensions{$extension};

    say "Translating files files: " . $extension;
    my $find_cmd = "find -L $base_path ";
    $find_cmd .= "-not -path '$base_path$_/*' " foreach @exclude_path;
    $find_cmd .= "-name '*.$extension'";
    $find_cmd .= " > /tmp/files_$extension.txt";
    system($find_cmd);
    system("cat /tmp/files_$extension.txt") if $verbose;

    $xgettext_cmd = $xgettext_bin . " " . $xgettext_args;
    $xgettext_cmd .= " --language=$language ";
    $xgettext_cmd .= " --from-code=UTF-8 ";
    $xgettext_cmd .= " -k$_ " foreach @keywords;
    $xgettext_cmd .= " -f /tmp/files_$extension.txt";
    $xgettext_cmd .= " -o /tmp/$extension.pot";
    $xgettext_cmd .= " 2>/dev/null";
    system($xgettext_cmd);

    unlink "/tmp/files_$extension.txt";

}

sub merge_templates
{
    unlink "/tmp/base.pot";
    system("msgcat /tmp/*.pot > /tmp/base.pot");
}

sub update_po_file
{
    my $locale = shift;
    say "Generating $locale.po";
    $msgmerge_cmd = $msgmerge_bin . " " . $msgmerge_args;
    $msgmerge_cmd .= " $base_path/application/languages/$locale/$locale.po";
    $msgmerge_cmd .= " /tmp/base.pot";
    $msgmerge_cmd .= " 2>/dev/null";
    system($msgmerge_cmd);

    # Remove POT-Creation line
    system("sed -i -e'/POT-Creation/d' $base_path/application/languages/$locale/$locale.po");
}

sub update_mo_file
{
    my $locale = shift;
    say "Generating $locale.mo";
    $msgfmt_cmd = $msgfmt_bin . " " . $msgfmt_args;
    $msgfmt_cmd .= " -o $base_path/application/languages/$locale/$locale.mo";
    $msgfmt_cmd .= " $base_path/application/languages/$locale/$locale.po";
    system($msgfmt_cmd);

}

$action = shift @ARGV;

if ($action eq "gettext") {
    foreach (keys %extensions) { &extract_strings($_); }
    &merge_templates;
    foreach (@locales) { &update_po_file($_); }
}

if ($action eq "update") {
    foreach (@locales) { &update_mo_file($_); }
}



