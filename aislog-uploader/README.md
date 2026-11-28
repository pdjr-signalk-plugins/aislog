# aislog-uploader

**aislog-uploader** is a stand-alone server which listens on a
specified UDP port for incoming AIS !AIVDM position reports, rejects
positional duplicates, and collates filtered reports into a daily log.
At end-of-day the daily log is emailed to a nominated recipient.

The end-of-day email can be configured to include attachments in
addition to the AIS log itself: either local files or the output from
API calls.

## Installation

1. Download the **aislog** git repository.

   ```bash
   cd ~
   git clone https://github.com/pdjr-signalk-plugins/aislog
   ```

2. Install **aislog-uploader** and its associated `systemd` service file.

   ```bash
   sudo cp aislog/aislog-uploader/aislog-uploader /usr/local/bin/
   sudo cp aislog/aislog-uploader/aislog-uploader.service /etc/systemd/system/
   sudo chmod 755 /usr/local/bin/aislog-uploader
   sudo chmod 644 /etc/systemd/system/aislog-uploader.service
   ```

3. Delete the no-longer required git repository.

   ```bash
   rm -rf aislog
   ```

4. Create a system user for the **aislog-uploader** service and restart
   `systemd`.

   ```bash
   sudo useradd -r -s /usr/sbin/nologin aislog-uploader
   sudo systemctl daemon-reload
   ```

5. Run **aislog-uploader** from the command line using the `-c`
   (configure) option and set the UDP port on which the server will
   listen for incoming AIS messages and the email recipient to whom
   consolidated daily logs will be posted.
   Do not simply copy the following command - set values appropriate
   for your use case.

   ```bash
   sudo aislog-uploader -c -p 12345 -r wordpress.user@example.com
   ```

6. If you want the service to run automatically on system reboot then
   enable the service (recommended).

   ```bash
   sudo systemctl enable aislog-uploader
   ```

## Running the service

**aislog-uploader** can be run from a terminal prompt with

```bash
aislog-uploader
```

But since the server immediately enters a listening loop this is only
really useful for configuration (with `-c` option), testing (with `-d`
and/or `-v` options) and displaying program documentation (with `-h`
option).

Typically, **aislog-uploader** will be started under systemd control.
Immediately after installation you can start the server for the first
time.

```bash
sudo systemctl start aislog-uploader
```

## Author

Paul Reeve <preeve_at_pdjr_dot_eu>
