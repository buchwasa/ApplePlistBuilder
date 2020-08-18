<?php

declare(strict_types=1);

namespace appleplistbuilder;

use SimpleXMLElement;

final class ApplePlistBuilder
{
    /** @var string */
    private $bundleId;
    /** @var string */
    private $title;
    /** @var string */
    private $url;
    /** @var string */
    private $bundleVersion;
    /** @var string */
    private $assetKind;
    /** @var string */
    private $metadataKind;

    public function __construct(string $bundleId, string $title, string $url, string $bundleVersion = "0.33.1", string $assetKind = "software-package", string $metadataKind = "software")
    {
        $this->bundleId = $bundleId;
        $this->title = $title;
        $this->url = $url;
        $this->bundleVersion = $bundleVersion;
        $this->assetKind = $assetKind;
        $this->metadataKind = $metadataKind;
    }

    public function getBundleId(): string
    {
        return $this->bundleId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getBundleVersion(): string
    {
        return $this->bundleVersion;
    }

    public function getAssetKind(): string
    {
        return $this->assetKind;
    }

    public function getMetadataKind(): string
    {
        return $this->metadataKind;
    }

    public function toPlist(): SimpleXMLElement
    {
        return simplexml_load_string(
            <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
		<plist version="1.0">
            <dict>
                <key>items</key>
                <array>
                    <dict>
                        <key>assets</key>
                        <array>
                            <dict>
                                <key>kind</key>
                                <string>$this->assetKind</string>
                                <key>url</key>
                                <string>$this->url</string>
                            </dict>
                        </array>
                        <key>metadata</key>
                        <dict>
                            <key>bundle-identifier</key>
                            <string>$this->bundleId</string>
                            <key>bundle-version</key>
                            <string>$this->bundleVersion</string>
                            <key>kind</key>
                            <string>$this->metadataKind</string>
                            <key>title</key>
                            <string>$this->title</string>
                        </dict>
                    </dict>
                </array>
            </dict>
        </plist>
XML
        );
    }
}
