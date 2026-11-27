# aislog
Create a WordPress ship's (b)log from AIS position reports.

**aislog** is a collection of scripts that log and, perhaps, present
AIS position reports as a consolidated log of ship's data. There are
a number of components.

**aislog-uploader** is small, stand-alone, server that listens on a
UDP port for incoming AIS position reports, discards duplicates, and
assembles a daily log which at the end of each day is emailed away for
archiving or further processing.

**aislog-wordpress** is a collection of WordPress plugins that accept
a log of AIS position reports and create from it a blog post that
presents the accumulated data in a meaningful way.
